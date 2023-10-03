<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    protected $guarded = ['products'];
    protected $with = ['purchaseProduct'];

    public function purchaseProduct(){
        return $this->hasMany(PurchaseProduct::class);
    }

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }
}
