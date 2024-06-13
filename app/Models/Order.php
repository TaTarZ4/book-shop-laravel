<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id' , 'cash'
    ];

    public function customer()
    {
        return $this->hasOne(Customer::class , 'id' , 'customer_id');
    }

    public function order_book()
    {
        return $this->hasMany(OrderBook::class , 'order_id' , 'id');
    }
}
