<?php

header('Content-Type: application/json; charset=UTF-8');
$hostname = shell_exec('hostname');
$uptime = (int) (shell_exec('cat /proc/uptime')/(60*60));
$os = shell_exec('cat /etc/issue');
echo json_encode(['hostname'=> $hostname, 'uptime' => $uptime, 'info' => $os]);
