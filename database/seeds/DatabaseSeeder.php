<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PropertyTypesTableSeeder::class,
            PostTypesTableSeeder::class,
            DistancesTableSeeder::class,
            ConveniencesTableSeeder::class,
            // CitiesTableSeeder::class,
            // DistrictsTableSeeder::class,
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            AdminsTableSeeder::class,
            UsersTableSeeder::class,
            FavoritesTableSeeder::class,
            BlogsTableSeeder::class,
        ]);
    }
}
