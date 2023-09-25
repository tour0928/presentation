<?php
if (isset($_POST["id"])) {
    if ($_POST["id"] != "") {
        $id = $_POST["id"];
        require_once "dbtools.php";

        $conn = create_connect();
        $sql = "SELECT ID, Name, Old FROM profiles WHERE ID = '$id'";

        $result = execute_sql($conn, 'tcnr02', $sql);
        if (mysqli_num_rows($result) == 1) {
            $mydata = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $mydata[] = $row;
            }
            echo '{"state" : true, "message" : "id驗證成功", "data" : ' . json_encode($mydata) . '}';
        } else {
            echo '{"state" : false, "message" : "id驗證失敗"}';
        }

        mysqli_close($conn);
    } else {
        echo '{"state" : false, "message" : "欄位不允許空白"}';
    }
} else {
    echo '{"state" : false, "message" : "欄位錯誤"}';
}

?>