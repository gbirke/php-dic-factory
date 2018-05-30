<?php
class ShoutPresenter {
    private $shouter;

    public function __construct( GreetingShouter $shouter ) {
        $this->shouter = $shouter;
    }

    public function present() {
        echo $this->shouter->shout() ."\n";
    }
}
