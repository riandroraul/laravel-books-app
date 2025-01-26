<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowingTransaction extends Model
{
    use HasFactory;

    protected $table = 'borrowing_transaction';

    protected $fillable = [
        'book_id',
        'user_id',
        'borrow_date',
        'return_date',
        'status',
    ];
}
