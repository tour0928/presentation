<?php
if (isset($_POST["username"]) && isset($_POST["password"])) {
  if ($_POST["username"] != "" && $_POST["password"] != "") {
    $p_username = $_POST["username"];
    $p_password = $_POST["password"];

    require_once "dbtools.php";
    // Create connection
    $conn = create_connect();

    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT username, password FROM users WHERE username = '$p_username' AND Password = '$p_password'";
    $result = execute_sql($conn, 'trend', $sql);

    if (mysqli_num_rows($result) == 1) {
      //0 回傳echo格式請務必正確，不然在login js呼叫login_api會錯誤
      //登入成功
      //1. 產生uid回傳至前端(儲存至cookie)
      //2. 並儲存至資料庫
      $uid = substr(hash('sha256', uniqid(time())), 0, 10);
      $sql = "UPDATE users SET uid = '$uid' WHERE username = '$p_username'";
      if (execute_sql($conn, 'trend', $sql)) {
        //撈取出最新的會員資料
        $sql = "SELECT username uid FROM users WHERE username = '$p_username' AND Password = '$p_password'";
        $result = execute_sql($conn, 'trend', $sql);

        $mydata = array();
        while ($row = mysqli_fetch_assoc($result)) {
          $mydata[] = $row;
        }

        echo '{"state" : true, "message" : "登入成功",  "data" : ' . json_encode($mydata) . '}';
      } else {
        //uid更新失敗
        echo '{"state" : false, "message" : "uid更新失敗}"';
      }
    } else {
      echo '{"state":false,"message":"登入失敗"}';
    }

    mysqli_close($conn);
  } else {
    echo '{"state": false, "message":"欄位不允許空白"}';
  }
} else {
  echo '{"state": false, "message":"欄位錯誤"}';
}
?>