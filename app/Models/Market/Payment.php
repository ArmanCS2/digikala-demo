<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public function paymentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        if ($this->type==0){
            return 'آنلاین';
        }

        if ($this->type==1){
            return 'آفلاین';
        }

        return 'نقدی';
    }

    public function status()
    {
        if ($this->status==0){
            return 'پرداخت نشده';
        }

        if ($this->status==1){
            return 'پرداخت شده';
        }

        if ($this->status==2){
            return 'لغو شده';
        }

        return 'بازگردانده شده';
    }
}
