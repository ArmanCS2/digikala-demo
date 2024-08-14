<?php

namespace App\Http\Livewire\Product;

use App\Models\Livewire\LivewireProduct;
use Livewire\Component;
use Livewire\WithFileUploads;
use Mockery\Exception;

class Create extends Component
{
    use WithFileUploads;
    public $title;
    public $description;
    public $price;
    public $image;
    protected $rules = [
        'title' => 'required|string',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'image' => 'required|image',
    ];

    public function updated($propertyName)
    {
      $this->validateOnly($propertyName);
    }

    public function create()
    {
        $this->validate();
        $imageName = $this->image->store('livewire_images/products', 'public');

        try {
            LivewireProduct::create([
                'title' => $this->title,
                'description' => $this->description,
                'price' => $this->price,
                'image' => $imageName,
            ]);
            $this->emit('swal',[
                'title'=>'موفق',
                'text'=>'محصول با موفقیت ایجاد شد',
                'confirmButtonText'=>'باشه',
                'icon'=>'success',
                //'timer'=>3000,
                //'position'=>'center',
                //'toast'=>true,
            ]);
            $this->reset();
        }catch (Exception $exception){
            $this->emit('swal',[
                'title'=>'خطا!',
                'text'=>$exception->getMessage(),
                'confirmButtonText'=>'باشه',
                'icon'=>'error',
                //'timer'=>3000,
                //'position'=>'center',
                //'toast'=>true,
            ]);
        }


    }
    public function render()
    {
        return view('livewire.product.create');
    }
}
