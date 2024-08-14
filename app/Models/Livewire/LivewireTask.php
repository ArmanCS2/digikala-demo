<?php

namespace App\Models\Livewire;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivewireTask extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function status()
    {
        if ($this->status == 0){
            return 'در حال انجام...';
        }
        if ($this->status == 1){
            return 'انجام شده';
        }

        return 'نامشخص';
    }
}
