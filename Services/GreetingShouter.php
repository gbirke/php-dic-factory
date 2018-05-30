<?php

class GreetingShouter {

    private $greeter;

    public function __construct( GreetService $greeter )
    {
        $this->greeter = $greeter;
    }

    public function shout() {
        return strtoupper( $this->greeter->greet() ) . '!!!';
    }
}
