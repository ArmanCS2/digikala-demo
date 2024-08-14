<?php

namespace App\Models\livewire;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivewireProduct extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function imageUrl()
    {
        return asset('storage/'.$this->image);
    }
}
