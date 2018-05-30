<?php

use Pimple\Container;

/**
 * This class "misuses" Pimple as a singleton storage, while foregoing its DIC capabilities.
 *
 * It has the advantage of getting type violations right away, even in the IDE,
 * but at the disadvantage of having two functions for every service.
 *
 * To see the singleton creation working without Pimple, see SingletonFactory
 */
class PimpleContainerFactory {

    private $container;

    public function __construct( array $config ) {
        $this->container = new Container();
        $this->container['greeter'] = function() use ( $config ) {
            return new GreetService( $config['greeting'] );
        };
        $this->container['shouter'] = function() {
            return new GreetingShouter( $this->getGreeter() );
        };
        $this->container['presenter'] = function() {
            return new ShoutPresenter( $this->getShouter() );
        };
    }

    public function getPresenter(): ShoutPresenter {
        return $this->container['presenter'];
    }

    private function getGreeter(): GreetService {
        return $this->container['greeter'];
    }

    private function getShouter(): GreetingShouter {
        return $this->container['shouter'];
    }
}
