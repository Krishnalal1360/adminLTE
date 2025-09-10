<?php
/*
namespace Database\Factories\Admin;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Admin\UserListModel;
use App\Models\Admin\UserModel;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\UserList>
 */
/*
class UserListFactory extends Factory
{
    protected $model = UserListModel::class;

    public function definition(): array
    {
        // Make sure there is at least one admin user to link
        $admin = UserModel::inRandomOrder()->first() ?? UserModel::factory()->create();

        return [
            'adminID'  => $admin->id,
            'name'     => $this->faker->name(),
            'email'    => $this->faker->unique()->safeEmail(),
            'password' => $admin->password, // Use same hashed password as admin
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
*/