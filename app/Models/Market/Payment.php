<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

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
        if ($this->type == 1) {
            return 'آنلاین';
        }

        if ($this->type == 2) {
            return 'آفلاین';
        }

        if ($this->type == 3) {
            return 'نقدی';
        }

        return 'نامشخص';
    }

    public function status()
    {
        if ($this->status == 0) {
            return 'پرداخت نشده';
        }

        if ($this->status == 1) {
            return 'پرداخت شده';
        }

        if ($this->status == 2) {
            return 'لغو شده';
        }

        return 'بازگردانده شده';
    }
}
