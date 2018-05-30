<?php

class SharedObjectFactory {

    private $container;
    private $config;

    public function __construct( array $config ) {
        $this->container = [];
        $this->config = $config;
    }

    public function getPresenter(): ShoutPresenter {
        return $this->getSharedObject( ShoutPresenter::class, function() {
            return new ShoutPresenter( $this->getShouter() );
        } );
    }

    private function getGreeter(): GreetService {
        return $this->getSharedObject( GreetService::class, function() {
            return new GreetService( $this->config['greeting'] );
        } );
    }

    private function getShouter(): GreetingShouter {
        return $this->getSharedObject( GreetingShouter::class, function() {
            return new GreetingShouter( $this->getGreeter() );
        } );
    }

    private function getSharedObject( string $id, callable $factory ) {
        if( !isset( $this->container[$id] ) ) {
            $this->container[$id] = $factory();
        }
        return $this->container[$id];
    }
}
