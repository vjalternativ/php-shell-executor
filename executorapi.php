<?php
require_once 'libs/lib_job.php';
$result = array("status"=>"failed");
if($_POST && isset($_POST['command'])) {
    $cmd = $_POST['command'];

    $jobId = lib_job::getInstance()->addNewJob("command", $cmd);

    $result['status'] = "success";

    $result['job_id'] = $jobId;

}
echo json_encode($result);
?>