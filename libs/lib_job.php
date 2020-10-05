<?php
class lib_job {

    private static $instance = null;
    static function getInstance() {
        if(self::$instance == null) {
            self::$instance = new lib_job();
        }

        return self::$instance;
    }

    function addNewJob($action,$payload) {
        $pwd = __DIR__.'/../jobs/';
        $file = uniqid();
        file_put_contents($pwd.$file, json_encode(array("action"=>$action,"payload"=>$payload)));
        return $file;
    }
}

?>