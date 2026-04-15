<?php

namespace App\Services\Admin;

use App\Dtos\Admin\Seller\CreateSellerDTO;
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
        $sellers = $this->seller->with('stores')->withCount('products')->get();

        return $sellers;
    }

    public function create(CreateSellerDTO $data): Seller
    {
        $logo_path = null;

        if ($data->logo !== null) {
            $logo_path = $this->s3Service->uploadFile($data->logo, 'sellers/logos');
        }

        try {
            // assuming owner account
            return DB::transaction(function () use ($data, $logo_path) {
                $seller = $this->seller->create([
                    'name' => $data->business_name,
                    'business_email' => $data->business_email,
                    'type' => $data->business_type,
                    'phone' => $data->business_phone,
                    'logo_path' => $logo_path,
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
                    'email' => $data->contact_email,
                    'phone' => $data->contact_phone,
                    'birth_date' => $data->birth_date,
                ]);

                $seller->users()->attach($user->id, ['role' => $data->seller_role->value]);

                return $seller;
            });
        } catch (\Exception $e) {
            \Log::error('Failed to create seller: '.$e->getMessage());
            // If logo was uploaded, delete it since the transaction failed
            if ($logo_path) {
                try {
                    $this->s3Service->deleteFile($logo_path);
                } catch (\Exception $ex) {
                    \Log::error('Failed to delete logo after transaction failure: '.$ex->getMessage());
                }
            }

            throw $e; // rethrow the original exception after cleanup
        }
    }

    public function findById(int $id): Seller
    {
        return $this->seller
            ->with('stores', 'users.profile', 'payoutMethods')
            ->withCount('products')
            ->findOrFail($id);
    }
}
