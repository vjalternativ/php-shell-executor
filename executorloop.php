<?php

$pwd= __DIR__.'/';
$jobdir = $pwd.'jobs/';
$resultdir = $pwd.'results/';
while(true) {
    $files = scandir($jobdir);
    unset($files[0]);
    unset($files[1]);
    foreach($files as $file) {
        $cmd = file_get_contents($jobdir.$file);

        $job = json_decode($cmd,1);
        if($job['action']=="command") {
            $res = shell_exec($job['payload']);
            $res = str_replace("\n", "<br/>", $res);
            $data = '<p>'.$job['payload'].'</p><p>'.$res.'</p>';
            file_put_contents($resultdir.$file, $data);
        } else if($job["action"]=="fileoperation"  && $job["payload"]["method"]=="delete") {
            $cmd = "rm -rf ".$job["payload"]["file"];
            shell_exec($cmd);
        }
        unlink($jobdir.$file);
        sleep(2);

    }
}
?>