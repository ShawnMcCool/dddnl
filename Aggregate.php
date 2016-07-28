<?php namespace Terminal;

class Aggregate {
    private $raisedEvents = [];
    public function releaseEvents() {
        $raisedEvents = $this->raisedEvents;
        $this->raisedEvents = [];
        return $raisedEvents;
    }
    public function raise($event) {
        $this->raisedEvents[] = $event;
        $this->applyEvent($event);
    }
}
