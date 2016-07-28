<?php namespace Terminal;

use Ramsey\Uuid\Uuid;

require_once __DIR__ . "/../../vendor/autoload.php";

$ProperTripCard = Card::purchaseNew(Uuid::uuid4()->toString());

// proper trip
$ProperTripCard->swipe(1, date('U')-120);
$ProperTripCard->swipe(2, date('U'));

$TooFastTripCard = Card::purchaseNew(Uuid::uuid4()->toString());

$TooFastTripCard->swipe(3, date('U')-10);
$TooFastTripCard->swipe(3, date('U'));

$dispatcher = new Dispatcher(\Example\Config::create());

foreach ($ProperTripCard->releaseEvents() as $event) {
    $dispatcher->dispatch($event->name(), $event->payload());
}

foreach ($TooFastTripCard->releaseEvents() as $event) {
    $dispatcher->dispatch($event->name(), $event->payload());
}
