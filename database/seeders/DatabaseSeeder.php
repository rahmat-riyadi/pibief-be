<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Purchase;
use App\Models\PurchaseProduct;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Vendor::factory(10)->create();

        Purchase::factory(10)->create();

        $data = Purchase::all();

        foreach($data as $i => $item){
            PurchaseProduct::create([
                'id' => Str::uuid()->toString(),
                'purchase_id' => $item->id,
                'product_name' => 'produk '. ($i+1),
                'unit' => 'pcs',
                'quantity' => 2,
                'taxes' => 'PPH',
                'price' => 20000,
                'total_price' => 38000
            ]);
            PurchaseProduct::create([
                'id' => Str::uuid()->toString(),
                'purchase_id' => $item->id,
                'product_name' => 'produk '. ($i+2),
                'unit' => 'pcs',
                'quantity' => 2,
                'taxes' => 'PPN',
                'price' => 20000,
                'total_price' => 38000
            ]);
        }
    }
}
