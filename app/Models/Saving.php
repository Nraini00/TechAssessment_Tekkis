<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Saving extends Model
{
    use HasFactory;
    protected $table = 'savings';


    protected $fillable = ['user_id', 'amount', 'bonus', 'bank'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
