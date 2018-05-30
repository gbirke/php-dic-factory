<?php

class GreetService {
    private $greeting;

    public function __construct( string $sayWhat ) {
        $this->greeting = $sayWhat;
    }

    public function greet(): string {
        return $this->greeting;
    }
}
