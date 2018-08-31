<?php
class App {

    public function go()
    {
        define("BASEPATH", realpath("../"));

        // Register autoloader
        require BASEPATH."/system/Autoloader.php";
        Autoloader::register();

        // TODO: Load error handler
        Router::Instance()->route();
    }

}