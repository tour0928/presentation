<?php
if (isset($_POST["name"]) && isset($_POST["old"])) {
    if ($_POST["name"] != "" && $_POST["old"] != "") {
        $name = $_POST["name"];
        //加上md5=加密 
        //substr(,0,5)擷取字元從第0開始擷取5個字  //369
        $old = $_POST["old"];

        require_once "dbtools.php";

        $conn = create_connect();
        $sql = "INSERT INTO profiles(Name, Old) VALUES ('$name', '$old')";
        if (execute_sql($conn, 'tcnr02', $sql)) {
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

?>