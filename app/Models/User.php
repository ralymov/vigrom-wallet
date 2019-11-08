<?php

namespace App;

use App\Models\Wallet;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int id
 * @property string name
 * @property string email
 * @property string password
 * @property string api_token
 * @property int wallet_id
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password',];
    protected $hidden = ['password', 'remember_token',];
    protected $casts = ['email_verified_at' => 'datetime',];

    /**
     * Set the password using bcrypt hash.
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = (password_get_info($value)['algo'] === 0) ? bcrypt($value) : $value;
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
