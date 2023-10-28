<?php

namespace App\Livewire;

use App\Models\Scooter;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminDashboard extends Component
{
    use WithFileUploads;

    public $scooters = [], $scootersAdd = false;
    public $name, $location, $status, $number, $price, $image;

    public function toggleScootersAdd(){
        $this->scootersAdd = !$this->scootersAdd;

        $this->reset(['name', 'location', 'status', 'number', 'price']);
    }

    public function addScooter(){
        $group = new Scooter();
        $group->name = $this->name;
        $group->location = $this->location;
        $group->number = $this->number;
        $group->price = $this->price;
        $group->image = $this->image->store('images', 'public');


        //get GEOCODING_API_KEY from .env file
        $api_key = env('GEOCODING_API_KEY');
        

        $url = "http://api.positionstack.com/v1/forward?access_key=".urlencode($api_key)."&query=".urlencode($this->location)."";
        $response = json_decode(file_get_contents($url), true);

        if($response){
            $group->latitude = $response['data'][0]['latitude'] ? $response['data'][0]['latitude'] : null;
            $group->longitude = $response['data'][0]['longitude'] ? $response['data'][0]['longitude'] : null;
        }

        $group->save();

        $this->reset(['name', 'location', 'status', 'number', 'price']);
        $this->scooters = Scooter::all();
    }

    public function mount(){
        $this->scooters = Scooter::all();
    }

    public function render()
    {
        return view('livewire.admin-dashboard');
    }
}
