<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\BlogModel;
use App\Models\Admin\UserModel;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //$users = UserModel::all();
        //
        BlogModel::factory()->count(10)->create(
            /*[
                'uid' => $users->random()->id,
            ]*/
        );
    }
}
