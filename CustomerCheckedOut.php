<?php namespace Terminal;

class CustomerCheckedOut {

    public $cardId;
    public $locationId;
    public $time;
    public $tripId;

    public function __construct($cardId, $locationId, $time, $tripId) {
        $this->cardId = $cardId;
        $this->locationId = $locationId;
        $this->time = $time;
        $this->tripId = $tripId;
    }

    public function name() {
        return "CustomerCheckedOut";
    }

    public function payload() {
        return [
            'cardId' => $this->cardId,
            'checkInLocationId' => $this->locationId,
            'timeOfCheckIn' => $this->time,
            'TripId' => $this->tripId,
        ];
    }
}
