<?php

require_once( __DIR__ . '/vendor/autoload.php' );

// Uncomment the factory you want to use

//$factory = new SharedObjectFactory( ['greeting' => 'Hello World' ] );
//$factory = new PimpleContainerFactory( ['greeting' => 'Hello World' ] );
//$factory = new PimpleWrapperFactory( ['greeting' => 'Hello World' ] );
$factory = new PhpDiFactory( ['greeting' => 'Hello World' ] );

$factory->getPresenter()->present();
