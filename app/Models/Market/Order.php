<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded=[];
    protected $casts=[
        'address_object'=>'object',
        'delivery_object'=>'object',
        'common_discount_object'=>'object',
        'copan_object'=>'object',
        'payment_object'=>'object'
        ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function copan()
    {
        return $this->belongsTo(Copan::class);
    }

    public function commonDiscount()
    {
        return $this->belongsTo(CommonDiscount::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function delivery_status()
    {
        if ($this->delivery_status === '0') {
            return 'ارسال نشده';
        }

        if ($this->delivery_status == 1) {
            return 'در حال ارسال';
        }


        if ($this->delivery_status == 2) {
            return 'ارسال شده';
        }

        if ($this->delivery_status == 3) {
            return 'تحویل داده شده';
        }

        return 'ارسال نشده';
    }

    public function delivery_type()
    {
        return $this->belongsTo(Delivery::class,'delivery_id');
    }

    public function payment_status()
    {
        if ($this->payment_status === '0') {
            return 'پرداخت نشده';
        }

        if ($this->payment_status == 1) {
            return 'پرداخت شده';
        }


        if ($this->payment_status == 2) {
            return 'لغو شده';
        }

        if ($this->payment_status == 2) {
            return 'بازگرداننده شده';
        }

        return 'پرداخت نشده';
    }
    public function payment_type()
    {
        if ($this->payment_type === '0') {
            return 'آنلاین';
        }

        if ($this->payment_status == 1) {
            return 'آفلاین';
        }

        if ($this->payment_status == 2) {
            return 'نقدی';
        }

        return 'نامشخص';
    }

    public function order_status()
    {
        if ($this->order_status === '0') {
            return 'بررسی نشده';
        }
        if ($this->order_status == 1) {
            return 'در انتظار تایید';
        }

        if ($this->order_status == 2) {
            return 'تایید شده';
        }

        if ($this->order_status == 3) {
            return 'تایید نشده';
        }

        if ($this->order_status == 4) {
            return 'مرجوع شده';
        }

        if ($this->order_status == 5) {
            return 'باطل شده';
        }

        return 'بررسی نشده';

    }

}
