<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Copan extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['code','amount','amount_type','discount_ceiling','status','type','user_id','start_date','end_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function amount_type()
    {
        return $this->amount_type==0 ? 'درصد' : 'تومان' ;
    }

    public function type()
    {
        return $this->type==0 ? 'عمومی' : 'خصوصی' ;
    }
}
