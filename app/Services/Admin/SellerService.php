<?php

namespace App\Services\Admin;

use App\Dtos\Admin\Seller\CreateSellerDTO;
use App\Dtos\Admin\Seller\SellerItemDTO;
use App\Enums\RoleName;
use App\Models\Role;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SellerService
{
    public function __construct(private Seller $seller) {}

    public function getAll(): Collection
    {
        $sellers = $this->seller->with('user.profile', 'stores')->withCount('products')->get();

        return $sellers->map(fn ($seller) => new SellerItemDTO(
            id: $seller->id,
            name: $seller->user->profile->first_name.' '.$seller->user->profile->last_name,
            email: $seller->user->email,
            store_type: $seller->type->value,
            created_at: $seller->created_at->format('M d, Y'),
            products_count: $seller->products_count,
            stores: $seller->stores->pluck('name')->toArray()
        ));
    }

    public function create(CreateSellerDTO $data): Seller
    {
        return DB::transaction(function () use ($data) {
            $role = Role::firstOrCreate(['name' => ($data->role ?? RoleName::Seller)->value]);

            $user = User::create([
                'email' => $data->email,
                'password' => $data->password,
                'email_verified_at' => now(),
                'role_id' => $role->id,
            ]);

            $user->profile()->create([
                'first_name' => $data->first_name,
                'last_name' => $data->last_name,
                'email' => $data->email,
                'phone' => $data->phone,
                'birth_date' => $data->birth_date,
            ]);

            return $this->seller->create([
                'user_id' => $user->id,
                'type' => $data->store_type,
            ]);
        });
    }
}
