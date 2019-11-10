<?php

namespace App\Models;

use App\Currency;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property float amount
 * @property int currency_id
 * @property Currency currency
 */
class Wallet extends Model
{
    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = $value;
        if ($this->attributes['amount'] < 0) {
            throw new \Exception('Wallet total amount cannot be negative.');
        }
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
