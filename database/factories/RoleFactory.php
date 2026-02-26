<?php

namespace Database\Factories;

use App\Enums\RoleName;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => RoleName::Buyer,
            "user_id" => User::factory()
        ];
    }

    /**
     * Function will be used in the RoleSeeder to populate the database
     * with users of different role
     * eg. Role::factory()->name(RoleName::SuperAdmin)->count(1)->create()
     *     Role::factory()->name(RoleName::Buyer)->count(10)->create()
     * @param RoleName $roleName
     * @return RoleFactory
     */
    public function name(RoleName $roleName): static
    {
        return $this->state(fn() => ['name' => $roleName]);
    }
}
