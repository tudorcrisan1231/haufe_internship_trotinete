<?php

namespace App\Livewire;

use App\Models\Reservation;
use App\Models\Scooter;
use Livewire\Component;
use Illuminate\Support\Facades\Cookie;

class Scooters extends Component
{
    public $scootersModal = true, $scooters = [];
    public $reservationModal = false, $location_details = null;
    public $currentRide = null, $endRideModal = false, $totalPayable = 0, $totalTime = 0, $endRideLocation = null, $endRideDistance = null;

    protected $listeners = ['openReservationModal' => 'openReservationModal'];


    public function closeScootersModal(){
        $this->scootersModal = false;
    }
    public function openScootersModal(){
        $this->scootersModal = true;
    }

    public function openReservationModal($id){
        if(!auth()->check()){
            return redirect()->route('login');
        }

        $this->reservationModal = true;

        $this->location_details = Scooter::find($id);

        // if($this->location_details->number)
    }

    public function closeReservationModal(){
        $this->reservationModal = false;

        $this->reset(['location_details']);
    }

    public function takeScooter(){
        $reservation = new Reservation();
        $reservation->user_id = auth()->user()->id;
        $reservation->scooter_id = $this->location_details->id;
        $reservation->start_time = date('Y-m-d H:i:s');
        $reservation->save();

        $scooter_location = Scooter::find($this->location_details->id);
        $scooter_location->number = $scooter_location->number - 1;
        $scooter_location->save();

        return redirect()->route('home')->with('success', 'Scooter taken successfully. Drive save!');
    }

    public function leftScooterToggle(){
        $this->endRideModal = !$this->endRideModal;

        $start_date = $this->currentRide->start_time;
        $end_date = date('Y-m-d H:i:s');

        $total_hours = ceil(round((strtotime($end_date) - strtotime($start_date)) / 3600, 2));

        $this->totalPayable = $total_hours * $this->currentRide->getScooter->price;
        $this->totalTime = $total_hours;

        // $this->endRideLocation = $this->currentRide->scooter_id;
    }

    public function endRide(){
        $this->validate([
            'endRideLocation' => 'required'
        ]);
   
        $this->currentRide->end_time = date('Y-m-d H:i:s');
        $this->currentRide->end_location = $this->endRideLocation;
        $this->currentRide->save();

        $scooter_location = Scooter::find($this->currentRide->scooter_id);
        $scooter_location->number = $scooter_location->number + 1;
        $scooter_location->save();

        return redirect()->route('home')->with('success', 'Scooter returned successfully. Thank you!');
    }

    public function verifyLocation(){
        $latitude = $_COOKIE['latitude'];
        $longitude = $_COOKIE['longitude'];
        
        $endRideLocationCoordinates = Scooter::where('id', $this->endRideLocation)->first();

        $this->endRideDistance = $this->calculateDistance($latitude, $longitude, $endRideLocationCoordinates->latitude, $endRideLocationCoordinates->longitude);
    }

    public function calculateDistance($lat1, $lon1, $lat2, $lon2) {
        //calculate distance between two points
        $earthRadius = 6371; // Earth's radius in kilometers
    
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
    
        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    
        $distance = $earthRadius * $c;
    
        return $distance;
    }

    public function mount(){
        $this->scooters = Scooter::all();

        if(auth()->check()){
            $ride = Reservation::where('user_id', auth()->user()->id)->whereNull('end_time')->first();
            if($ride){
                $this->currentRide = $ride;
            }
        }
    }

    public function render()
    {
        return view('livewire.scooters');
    }
}
