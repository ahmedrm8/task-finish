<?php
require_once "connection.php";
function getCustomerList() {
  global $conn;
  $select_users = "SELECT users.*, priv.priv_name FROM `users` INNER JOIN `priv` ON users.user_priv = priv.priv_id";
  $query_run = mysqli_query($conn, $select_users);
  if($query_run) {
    if(mysqli_num_rows($query_run) > 0) {
      $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
      $data = [
        'status' => '200',
        'message' => 'Customer List Fetched Successfully',
        'data' => $res
      ];
      header("HTTP/1.0 200 OK");
      return json_encode($data);
    } else {
      $data = [
        'status' => '404',
        'message' => 'No Customer Found',
      ];
      header("HTTP/1.0 404 No Customer Found");
      return json_encode($data);
    }
  } else {
    $data = [
      'status' => '500',
      'message' => 'Internal Server Error',
    ];
    header("HTTP/1.0 500 Internal Server Error");
    return json_encode($data);
  }
}
?>