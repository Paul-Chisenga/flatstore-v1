<?php

namespace App\Services\Admin;

use App\Dtos\Admin\Seller\CreateSellerDTO;
use App\Enums\SellerRole;
use App\Enums\UserRole;
use App\Models\Seller;
use App\Models\User;
use App\Services\S3Service;
use Illuminate\Support\Facades\DB;

class SellerService
{
    public function __construct(private Seller $seller, private S3Service $s3Service) {}

    public function getAll()
    {
        return $this->seller
            ->with([
                'stores',
                'users' => fn ($query) => $query->with('profile')->orderByPivot('store_id')->orderBy('email'),
            ])
            ->withCount('products')
            ->get();
    }

    public function create(CreateSellerDTO $data): Seller
    {
        $sellerLogoPath = null;
        $storeLogoPath = null;

        if ($data->logo !== null) {
            $sellerLogoPath = $this->s3Service->uploadFile($data->logo, 'sellers/logos');
        }

        if ($data->store_logo !== null) {
            $storeLogoPath = $this->s3Service->uploadFile($data->store_logo, 'stores/logos');
        }

        try {
            return DB::transaction(function () use ($data, $sellerLogoPath, $storeLogoPath) {
                $seller = $this->seller->create([
                    'name' => $data->business_name,
                    'business_email' => $data->business_email,
                    'type' => $data->business_type,
                    'phone' => $data->business_phone,
                    'logo_path' => $sellerLogoPath,
                ]);

                $user = User::create([
                    'email' => $data->email,
                    'password' => $data->password,
                    'email_verified_at' => now(),
                    'role' => UserRole::Seller->value,
                ]);

                $user->profile()->create([
                    'first_name' => $data->first_name,
                    'last_name' => $data->last_name,
                    'email' => $data->contact_email ?? $data->email,
                    'phone' => $data->contact_phone,
                    'birth_date' => $data->birth_date,
                ]);

                $store = $seller->stores()->create([
                    'name' => $data->store_name,
                    'email' => $data->store_email,
                    'phone' => $data->store_phone,
                    'logo_path' => $storeLogoPath,
                ]);

                $store->address()->create([
                    'country' => $data->country,
                    'state' => $data->state,
                    'city' => $data->city,
                    'street' => $data->street,
                    'postal_code' => $data->postal_code,
                ]);

                $this->assignUserToSeller($seller, $user, $data->seller_role, $store->id);

                return $seller->load([
                    'stores.address',
                    'users' => fn ($query) => $query->with('profile')->orderByPivot('store_id')->orderBy('email'),
                ])->loadCount('products');
            });
        } catch (\Exception $e) {
            \Log::error('Failed to create seller: '.$e->getMessage());

            foreach (array_filter([$sellerLogoPath, $storeLogoPath]) as $uploadedFilePath) {
                try {
                    $this->s3Service->deleteFile($uploadedFilePath);
                } catch (\Exception $cleanupException) {
                    \Log::error('Failed to delete uploaded file after seller creation failure: '.$cleanupException->getMessage());
                }
            }

            throw $e;
        }
    }

    public function findById(int $id): Seller
    {
        return $this->seller
            ->with([
                'stores',
                'payoutMethods',
                'users' => fn ($query) => $query->with('profile')->orderByPivot('store_id')->orderBy('email'),
            ])
            ->withCount('products')
            ->findOrFail($id);
    }

    private function assignUserToSeller(Seller $seller, User $user, SellerRole $role, ?int $storeId = null): void
    {
        $seller->users()->syncWithoutDetaching([
            $user->id => [
                'role' => $role->value,
                'store_id' => $storeId,
            ],
        ]);
    }
}
