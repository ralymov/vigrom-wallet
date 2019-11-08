<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionReason extends Model
{
    public $timestamps = false;
    public const STOCK = 'stock';
    public const REFUND = 'refund';
}
