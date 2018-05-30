<?php

use Psr\Container\ContainerInterface;
use DI\ContainerBuilder;

class PhpDiFactory {
    private $container;

    public function __construct( array $config ) {
        $builder = new ContainerBuilder();
        $builder->addDefinitions( $config );
        $builder->addDefinitions( [
            GreetService::class => function ( ContainerInterface $c ) {
                return new GreetService( $c->get( 'greeting' ) );
            }
        ] );
        $this->container = $builder->build();
    }

    public function getPresenter(): ShoutPresenter {
        return $this->container->get( ShoutPresenter::class );
    }
}
