<?php namespace Terminal;

class CardWasPurchased {

    private $cardId;

    public function __construct($cardId) {
        $this->cardId = $cardId;
    }

    public function name() {
        return 'CardWasPurchased';
    }

    public function payload() {
        return [
            'CardId' => $this->cardId
        ];
    }
}
