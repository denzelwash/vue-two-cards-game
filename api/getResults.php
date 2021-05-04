<?php

header('Access-Control-Allow-Origin: http://localhost:8080');

include_once("db.php");

$sql = "SELECT * FROM results";
$query = dbQuery($sql);
dbCheckQuery($query);
$result = $query->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($result);
