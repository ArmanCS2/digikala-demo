<?php

namespace App\Models\livewire;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivewireCartItem extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function product()
    {
        return $this->belongsTo(LivewireProduct::class, 'livewire_product_id');
    }
}
