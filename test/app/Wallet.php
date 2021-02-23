<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Wallet extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
