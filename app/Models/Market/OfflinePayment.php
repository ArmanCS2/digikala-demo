<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfflinePayment extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded=[];

    public function payments()
    {
        return $this->morphMany('App\Models\Market\Payment','paymentable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
