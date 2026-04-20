<?php

namespace App\Actions\Auth;

use App\Dtos\Auth\CreateUserDTO;
use App\Models\Profile;
use App\Models\User;
use DB;

class CreateUserAction
{
    public function execute(CreateUserDTO $data)
    {
        return DB::transaction(function () use ($data) {

            $user = User::create([
                'email' => $data->email,
                'password' => bcrypt($data->password),
                'provider_id' => $data->provider_id,
                'provider' => $data->provider,
                'email_verified_at' => $data->email_verified_at,
            ]);
            Profile::create([
                'first_name' => $data->first_name,
                'last_name' => $data->last_name,
                'email' => $data->email,
                'user_id' => $user->id,
            ]);

            return $user;
        });
    }
}
