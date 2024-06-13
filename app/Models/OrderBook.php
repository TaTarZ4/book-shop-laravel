<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderBook extends Model
{
    use HasFactory;

    // protected $table = ['order_books'];
    protected $fillable = [
        'order_id' , 'book_id' , 'qty'
    ];

    public function order()
    {
        return $this->hasOne(Order::class , 'id' , 'order_id');
    }

    public function book()
    {
        return $this->hasOne(Book::class , 'id' , 'book_id');
    }
}
