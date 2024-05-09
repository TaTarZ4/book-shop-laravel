<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_is','qty'
    ];

    public function book()
    {
        return $this->hasOne(Book::class , 'id' , 'book_is');
    }
}
