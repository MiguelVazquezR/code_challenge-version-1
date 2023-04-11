<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SupplierProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['product_id', 'supply_id'];

    // relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function Supply()
    {
        return $this->belongsTo(Supplier::class);
    }
}
