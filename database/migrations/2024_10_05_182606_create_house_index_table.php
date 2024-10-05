<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('house_index', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price')->default(0);
            $table->integer('bedrooms')->default(0);
            $table->integer('bathrooms')->default(0);
            $table->integer('storeys')->default(0);
            $table->integer('garages')->default(0);
        });

        // Правильно это сделать с помощью Seeder-а
        // И я бы это сделал при помощи Seeder-а
        // Но согласно условиям задачи нужно предоставить миграции
        // то пусть это будет миграция
        // Существенной разницы тут нет


        $data = [
            [
                'name' => 'The Victoria',
                'price' => 250000,
                'bedrooms' => 3,
                'bathrooms' => 2,
                'storeys' => 2,
                'garages' => 2,
            ],
            [
                'name' => 'The Xavier',
                'price' => 300000,
                'bedrooms' => 4,
                'bathrooms' => 3,
                'storeys' => 1,
                'garages' => 2,
            ],
            [
                'name' => 'The Como',
                'price' => 200000,
                'bedrooms' => 2,
                'bathrooms' => 1,
                'storeys' => 1,
                'garages' => 1,
            ],
            [
                'name' => 'Green Meadows',
                'price' => 350000,
                'bedrooms' => 5,
                'bathrooms' => 3,
                'storeys' => 2,
                'garages' => 3,
            ],
            [
                'name' => 'The Geneva',
                'price' => 400000,
                'bedrooms' => 6,
                'bathrooms' => 3,
                'storeys' => 2,
                'garages' => 2,
            ],
            [
                'name' => 'Lakeview Estatesa',
                'price' => 400000,
                'bedrooms' => 6,
                'bathrooms' => 3,
                'storeys' => 2,
                'garages' => 2,
            ],
            [
                'name' => 'The Clifton',
                'price' => 400000,
                'bedrooms' => 6,
                'bathrooms' => 3,
                'storeys' => 2,
                'garages' => 2,
            ],
            [
                'name' => 'Hilltop',
                'price' => 400000,
                'bedrooms' => 6,
                'bathrooms' => 3,
                'storeys' => 2,
                'garages' => 2,
            ]
        ];

        foreach ($data as $house) {
            DB::table('house_index')->insert($house);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('house_index');
    }
};
