<?php

use Pimple\Container;

class PimpleWrapperFactory {

    private $container;

    public function __construct( array $config ) {
        $this->container = new Container();
        $this->container['greeting'] = $config['greeting'];
        $this->container['greeter'] = function( Container $c ) {
            return new GreetService( $c['greeting'] );
        };
        $this->container['shouter'] = function( Container $c ) {
            return new GreetingShouter( $c['greeter'] );
        };
        $this->container['presenter'] = function( Container $c ) {
            return new ShoutPresenter( $c['shouter'] );
        };
    }

    public function getPresenter(): ShoutPresenter {
        return $this->container['presenter'];
    }

}
