<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastname',
        'email'
    ];
    public $timestamps = false;

    // relationships
    public function order()
    {
        return $this->hasOne(Client::class);
    }
}
