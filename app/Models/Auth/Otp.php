<?php

namespace App\Models\Auth;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;
    protected $fillable=['user_id','login_id','token','otp_code','type','status','used'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
