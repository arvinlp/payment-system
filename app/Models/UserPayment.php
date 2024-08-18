<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPayment extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the UserWallet
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    /**
     * Get the user that owns the UserWallet
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service(){
        return $this->hasOne(Service::class, 'id', 'service_id');
    }
    /**
     * Get the user that owns the UserWallet
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reseller(){
        return $this->belongsTo(Reseller::class, 'user_id');
    }
    /**
     * Get the user that owns the UserWallet
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin(){
        return $this->belongsTo(Admin::class, 'user_id');
    }

    public function currency(){
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }
}
