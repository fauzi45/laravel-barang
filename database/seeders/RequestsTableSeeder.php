<?php

namespace Database\Seeders;

use App\Models\Request;
use App\Models\RequestItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Request::factory(10)->create()->each(function ($request) {
            $request->items()->saveMany((RequestItem::factory(rand(1, 10)))->create())->make();
        });
    }
}
