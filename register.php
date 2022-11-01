<?php

//Gather data from client side HTML
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $uName = $_POST['uName'];
    $pw = $_POST['pass'];

//Functions
    function openDatabase(&$conID) {
        $host = "localhost"; $db = "ACM8062"; $usr = "root"; $pw = "";
        $conID = new mysqli($host, $usr, $pw, $db);
        if ($conID->connect_error) {
            die("Connection failed: " . $conID->connect_error);
        }
    }

    function write($conID, $fName, $lName, $email, $uName, $pw) {
        $SQL = " INSERT INTO Members (firstName, lastName, email, userName, password)";
        $SQL = $SQL. " VALUES ('$fName', '$lName', '$email', '$uName', SHA1('$pw'))";

        $result = $conID->query($SQL);

        if (!$result) {
            die("Query Error: " . $SQL . " :" . $conID->connect_error);
        } else {
            return true;
        }
    }

//Main
    //This program was written by Kyle Gause on 10/27/2022
    openDatabase($conID);
    if (write($conID, $fName, $lName, $email, $uName, $pw)) {
        echo"<h1> Your information has been stored successfully $fName</h1>";
    }
    $conID->close();
?>