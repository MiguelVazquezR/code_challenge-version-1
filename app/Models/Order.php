<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['order_number', 'status_id', 'client_id'];

    // relationships
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}