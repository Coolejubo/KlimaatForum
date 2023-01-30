<?php
include_once 'showPostsFunctions.php';
include_once 'connection.php';

$uid = 18;

print fetchUsername($uid, $connection);
