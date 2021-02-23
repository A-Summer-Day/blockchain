<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Wallet;

class User extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'wallet_id'
    ];

    public function wallets() {
        return $this->hasMany(Wallet::class);
    }
}
