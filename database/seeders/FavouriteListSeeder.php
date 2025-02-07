<?php
namespace Database\Seeders;
use App\Models\FavouriteList;
use Illuminate\Database\Seeder;

class FavouriteListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FavouriteList::factory()->count(5)->create();
    }
}
