<?php

namespace App\Http\Livewire\App\Search;

use App\Models\Market\Product;
use Livewire\Component;

class Search extends Component
{
    public $search;
    public function render()
    {
        $products=Product::where('name','like','%'.$this->search . '%')->where('status',1)->get();
        return view('livewire.app.search.search',compact('products'));
    }
}
