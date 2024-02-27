<?php

namespace App\Models\Ticket;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['subject', 'description', 'status', 'seen','reference_id','user_id','category_id','priority_id','ticket_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class,'reference_id');
    }

    public function priority()
    {
        return $this->belongsTo(TicketPriority::class,'priority_id');
    }

    public function category()
    {
        return $this->belongsTo(TicketCategory::class,'category_id');
    }

    public function parent()
    {
        return $this->belongsTo($this,'ticket_id');
    }

    public function children()
    {
        return $this->hasMany($this,'ticket_id');
    }

    public function file()
    {
        return $this->hasOne(TicketFile::class,'ticket_id');
    }
}
