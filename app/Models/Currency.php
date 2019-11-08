<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string code
 * @property float exchange_rate
 */
class Currency extends Model
{
    public $timestamps = false;
    public const RUB = 'RUB';
    public const USD = 'USD';
}
