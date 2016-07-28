<?php namespace Terminal;

class Card extends Aggregate {

    private $cardId;
    private $currentTripId = 0;
    private $isCheckedIn = false;

    public static function purchaseNew($cardId) {
        $card = new Card();
        $card->raise(new CardWasPurchased($cardId));
        return $card;
    }

    public function __construct() {}

    public function swipe($locationId, $time) {
        if ($this->isCheckedIn) {
            $this->raise(new CustomerCheckedOut($this->cardId, $locationId, $time, $this->currentTripId));
        } else {
            $this->raise(new CustomerCheckedIn($this->cardId, $locationId, $time, $this->currentTripId+1));
        }
    }

    public function applyEvent($event) {
        $payload = $event->payload();

        switch(get_class($event)) {
            case CardWasPurchased::class:
                $this->cardId = $payload['CardId'];
                break;
            case CustomerCheckedOut::class:
                $this->isCheckedIn = false;
                break;
            case CustomerCheckedIn::class:
                $this->isCheckedIn = true;
                $this->currentTripId = $payload['TripId'];
                break;
        }
    }
}
