<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Referral extends Model
{
    use HasFactory;
    protected $table = 'referrals';


    protected $fillable = ['referrer_id', 'referred_email', 'referred_name'];

    // Referral model
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }


    public function referred()
    {
        return $this->belongsTo(User::class, 'referred_id');
    }
    
}
