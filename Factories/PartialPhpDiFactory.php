<?php

use Psr\Container\ContainerInterface;
use DI\ContainerBuilder;

class PartialPhpDiFactory {
	private $config;
	private $container;

    public function __construct( array $config ) {
    	$this->config = $config;

        $builder = new ContainerBuilder();

        $builder->addDefinitions( [
            GreetService::class => function() {
                return new GreetService( $this->config['greeting'] );
            }
        ] );

        $this->container = $builder->build();
    }

    public function getPresenter(): ShoutPresenter {
        return $this->container->get( ShoutPresenter::class );
    }
}
