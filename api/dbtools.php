<?php
    function create_connect(){
        $link = mysqli_connect("localhost", "root", "") 
            or die("連線失敗".mysqli_connect_errno());
            return $link;
    }

    function execute_sql($link, $dbname, $sql){
        mysqli_select_db($link, $dbname) or die("連線資料失敗".mysqli_error($link));
        $result = mysqli_query($link, $sql);
        return $result;
    }
?>