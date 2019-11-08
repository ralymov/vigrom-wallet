<?php

namespace App\Models;

use App\Currency;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property int amount
 * @property int currency_id
 */
class Wallet extends Model
{
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
