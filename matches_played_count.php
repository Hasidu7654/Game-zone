<?php
// matches_played_count.php
// users table eke id saha matches_played column dekama ganna
include 'config.php';
header('Content-Type: application/json');
$data = [];
$res = $conn->query("SELECT id, matches_played FROM users");
if ($res) {
  while ($row = $res->fetch_assoc()) {
    $data[] = [
      'id' => $row['id'],
      'matches_played' => $row['matches_played']
    ];
  }
}
echo json_encode($data);
