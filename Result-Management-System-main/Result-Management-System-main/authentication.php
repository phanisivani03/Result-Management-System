<?php
    include_once('connection.php');
    //included to connect to database
    if (isset($_POST['login'])) {
        $username = $_POST['user'];//username from webpage
        $pwd = $_POST['pass'];//pwd from webpage
        $type = $_POST['type'];//login type from webpage
        session_start();//start session

        $_SESSION["user"] = $username;//session variable to use anywhere

        //to prevent from mysqli injection
        $username = stripcslashes($username);
        $pwd = stripcslashes($pwd);
        $type = stripcslashes($type);
        $username = mysqli_real_escape_string($con, $username);
        $pwd = mysqli_real_escape_string($con, $pwd);
        $type = mysqli_real_escape_string($con, $type);
        
        //Executing mysql queries to retrieve data
        $sql = "select * from user where username = '$username' and password = '$pwd'";
        $sql2 = "select * from lecturer where id = '$username' and password = '$pwd'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        $result2 = mysqli_query($con, $sql2);
        $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
        $count2 = mysqli_num_rows($result2);

        if ($count == 1) {
            if ($type == "1") {
                echo "<script type = \"text/javascript\">
                window.location = (\"result.php\")
                </script>"; //if student login, redirect to student's induvidual webpage
            }
        } elseif ($count2 == 1) {
            if ($type == "0") {
                echo "<script type = \"text/javascript\">
                window.location = (\"project.html\")
                </script>";//if lecturer login, redirect to lecturer's induvidual webpage
            }
        } else {
            echo "<script type = \"text/javascript\">
                window.location = (\"index.html\")
                </script>";//if wrong pwd redirect to the login page again
        }
    }
