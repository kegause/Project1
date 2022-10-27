<?php

//Gather data from client side HTML
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $emial = $_POST['email'];
    $uName = $_POST['uName'];
    $pw = $_POST['pass'];

//Functions
    function openDatabase(&$conID) {

    }

    function write($conID, $fName, $lName, $emial, $uName, $pw) {

    }

//Main
    //This program was written by Kyle Gause on 10/27/2022
    openDatabase($conID);
    if (write($conID, $fName, $lName, $emial, $uName, $pw)) {
        echo"<h1> Your information has been stored successfully . $fName</h1>";
    }
    $conID->close();
?>