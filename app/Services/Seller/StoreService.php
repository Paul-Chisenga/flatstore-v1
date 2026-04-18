<?php

namespace App\Services\Seller;

use App\Dtos\Seller\Store\CreateStoreDTO;
use App\Models\Store;
use App\Services\S3Service;
use Illuminate\Support\Facades\DB;

class StoreService
{
    public function __construct(private Store $store, private S3Service $s3Service)
    {
        //
    }

    public function getAll(string $seller_id)
    {
        $stores = $this->store->with('seller')->where('seller_id', $seller_id)->get();

        return $stores;
    }

    public function create(CreateStoreDTO $data)
    {
        // handle logo upload if exists
        $logo_path = null;

        if (isset($data->logo)) {
            $logo_path = $this->s3Service->uploadFile($data->logo, 'stores/logos');
        }

        try {
            return DB::transaction(function () use ($data, $logo_path) {

                $store = $this->store->create([
                    'seller_id' => $data->seller_id,
                    'name' => $data->store_name,
                    'contact_email' => $data->store_email,
                    'phone_number' => $data->store_phone,
                    'logo_path' => $logo_path,
                ]);

                // add address
                $store->address()->create([
                    'street' => $data->street,
                    'city' => $data->city,
                    'state' => $data->state,
                    'postal_code' => $data->postal_code,
                    'country' => $data->country,
                ]);

                return $store;

            });
        } catch (\Exception  $e) {
            // clear uploaded logo if store creation fails
            if ($logo_path) {
                $this->s3Service->deleteFile($logo_path);
            }
            throw $e;
        }
    }

    public function update(Store $store, CreateStoreDTO $data)
    {
        // handle logo upload if exists
        $old_logo_path = $store->logo_path;
        $logo_path = null;

        if (isset($data->logo)) {
            $logo_path = $this->s3Service->uploadFile($data->logo, 'stores/logos');
        }

        try {
            $res = DB::transaction(function () use ($store, $data, $logo_path) {

                $store->update([
                    'name' => $data->store_name,
                    'contact_email' => $data->store_email,
                    'phone_number' => $data->store_phone,
                    'logo_path' => $logo_path,
                ]);

                // update or create address
                $store->address()->updateOrCreate([], [
                    'street' => $data->street,
                    'city' => $data->city,
                    'state' => $data->state,
                    'postal_code' => $data->postal_code,
                    'country' => $data->country,
                ]);

                return $store;

            });
            // Delete old logo if it exists
            if ($old_logo_path && $logo_path) {
                // Attempt to delete the old logo, but don't fail the update if it fails
                try {
                    $this->s3Service->deleteFile($old_logo_path);
                } catch (\Exception $e) {
                    // Log the error but don't fail the update
                    \Log::error('Failed to delete old logo from S3: '.$e->getMessage());
                }
            }

            return $res;
        } catch (\Exception  $e) {
            throw $e;
        }
    }

    public function delete(Store $store)
    {
        try {
            $logo_path = $store->logo_path;

            DB::transaction(function () use ($store) {
                // delete address
                $store->address()->delete();

                // delete store
                $store->delete();
            });

            // delete logo if exists
            if ($logo_path) {
                try {
                    $this->s3Service->deleteFile($logo_path);
                } catch (\Exception $e) {
                    // Log the error but don't fail the deletion
                    \Log::error('Failed to delete logo from S3: '.$e->getMessage());
                }
            }
        } catch (\Exception  $e) {
            throw $e;
        }

    }

    public function findById(int $id): Store
    {
        return $this->store
            ->with('seller', 'address', 'productVariations.product', 'shippingMethods')
            ->withCount(['variationStocks as products_count'])
            ->findOrFail($id);
    }
}
