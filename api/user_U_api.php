<?php
if (isset($_POST["id"]) && isset($_POST["name"]) && isset($_POST["old"])) {
    if ($_POST["id"] != "" && $_POST["name"] != "" && $_POST["old"] != "") {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $old = $_POST["old"];

        require_once "dbtools.php";

        $conn = create_connect();

        $sql = "UPDATE profiles SET Name ='$name', Old='$old' WHERE ID = '$id' ";
        if (execute_sql($conn, 'tcnr02', $sql)) {
            echo '{"state" : true, "message" : "更新成功"}';
        } else {
            echo '{"state" : false, "message" : "更新失敗"}';
        }

        mysqli_close($conn);
    } else {
        echo '{"state" : false, "message" : "欄位不允許空白"}';
    }

} else {
    echo '{"state" : false, "message" : "欄位錯誤"}';
}
?>