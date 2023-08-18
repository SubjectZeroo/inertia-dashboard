<?php

namespace Database\Seeders;

use App\Models\ItemCategory;
use App\Models\ItemSubcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ItemCategory::create([
            'name'          =>  'Root',
            'description'   =>  'This is the root category, don\'t delete this one',
        ]);

        ItemCategory::factory(50)
        ->has(ItemSubcategory::factory()->count(2), 'item_subcategories')
        ->create();
    }
}
