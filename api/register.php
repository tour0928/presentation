<?php
if (isset($_POST["username"]) && isset($_POST["password"])) {
    if ($_POST["username"] != "" && $_POST["password"] != "") {
        $p_username = $_POST["username"];
        $p_password = $_POST["password"];

        require_once "dbtools.php";

        $conn = create_connect();
        $sql = "INSERT INTO users(username, password) VALUES ('$p_username', '$p_password')";
        if (execute_sql($conn, 'trend', $sql)) {
            echo '{"state" : true, "message" : "註冊成功"}';
        } else {
            echo '{"state" : false, "message" : "註冊失敗"}';
        }
        mysqli_close($conn);
    } else {
        echo '{"state" : false, "message" : "欄位不允許空白"}';
    }
} else {
    echo '{"state" : false, "message" : "欄位錯誤"}';
}