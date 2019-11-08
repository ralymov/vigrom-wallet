<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property int wallet_id
 * @property int type_id
 * @property int reason_id
 * @property int amount
 */
class Transaction extends Model
{
    public $guarded = ['id'];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function type()
    {
        return $this->belongsTo(TransactionType::class);
    }

    public function reason()
    {
        return $this->belongsTo(TransactionReason::class);
    }
}
