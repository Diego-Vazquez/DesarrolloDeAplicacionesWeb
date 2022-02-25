<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        /*
        $this->truncateTables([
            'users'
        ]);
        */

        //CREAR SEEDER
        //php artisan make:seeder NombreSeeder

        //EJECUTA E INSERTA LOS DATOS EN LA BD
        //php artisan db:seed
        $this->call(UsersSeeder::class);
        $this->call(CategoriesSeeder::class);

    }
}
