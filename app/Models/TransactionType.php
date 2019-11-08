<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    public $timestamps = false;
    public const DEBIT = 'debit';
    public const CREDIT = 'credit';
}
