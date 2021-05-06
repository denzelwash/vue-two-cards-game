<?php

// header('Access-Control-Allow-Origin: http://localhost:8080');

include_once("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $postData = file_get_contents('php://input');
  $data = json_decode($postData, true);

  if ($data['str'] !== 'test') {
    exit();
  }

  $name = $data['name'];
  $time = $data['time'];

  $result = [
    'name' => htmlspecialchars($name),
    'time' => htmlspecialchars($time)
  ];
  $sql = "INSERT INTO results (name, time) VALUES (:name, :time)";
  $query = dbQuery($sql, $result);
  dbCheckQuery($query);
  $addedId = dbInstance()->lastInsertId();
  echo $addedId;
} else {
  exit();
}
