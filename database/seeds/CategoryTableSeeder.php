<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $is_exist = Category::all();

        if (!$is_exist->count()) {
            $category = new Category();
            $category->name = 'Veículos Diesel';
            $category->slug = 'veiculo-diesel';
            $category->icon_class = 'fa-oil-can';
            $category->is_active = 1;
            $category->save();

            $category = new Category();
            $category->name = 'Veículos Ciclo Otto';
            $category->slug = 'veiculo-ciclo-otto';
            $category->icon_class = 'fa-gas-pump';
            $category->is_active = 1;
            $category->save();

            $category = new Category();
            $category->name = 'Gestão e Administrativos';
            $category->slug = 'gestao-administrativos';
            $category->icon_class = 'fa-tasks';
            $category->is_active = 1;
            $category->save();

            $category = new Category();
            $category->name = 'Eletroeletrônica';
            $category->slug = 'eletroeletronica';
            $category->icon_class = 'fa-microchip';
            $category->is_active = 1;
            $category->save();
        }
    }
}
