<?php
require_once 'libs/lib_job.php';
$pwd = __DIR__.'/';
$resultdir = $pwd.'results/';
$files = scandir($resultdir);
unset($files[0]);
unset($files[1]);
$requestId = $_GET['job_id'];
$result = array("status"=>"failed");
if(file_exists($resultdir.$requestId)) {
    $content = file_get_contents($resultdir.$requestId);
    lib_job::getInstance()->addNewJob("fileoperation", array("method"=>"delete","file"=>$resultdir.$requestId));
    $result["status"] = "success";
    $result["content"] = $content;
}

echo json_encode($result);

?>