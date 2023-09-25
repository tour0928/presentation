<?php
if (isset($_POST["id"])) {
    if ($_POST["id"] != "") {
        $id = $_POST["id"];

        require_once "dbtools.php";

        $conn = create_connect();
        $sql = "DELETE FROM profiles WHERE ID = '$id' ";
        if (execute_sql($conn, 'tcnr02', $sql)) {
            echo '{"state" : true, "message" : "刪除成功"}';
        } else {
            echo '{"state" : false, "message" : "刪除失敗"}';
        }

        mysqli_close($conn);
    } else {
        echo '{"state" : false, "message" : "欄位不允許空白"}';
    }

} else {
    echo '{"state" : false, "message" : "欄位錯誤"}';
}



?>