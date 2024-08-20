<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Specify the table name if it's not the plural form of the model name
    protected $table = 'orders';

    // Define the fillable attributes
    protected $fillable = [
        'transaction_id', 'name', 'email', 'phone', 'amount', 'status', 'address', 'currency'
    ];

    // If you have timestamps in your table, Laravel will handle them automatically.
    // If not, you can disable them by adding the following property:
    // public $timestamps = false;
}
