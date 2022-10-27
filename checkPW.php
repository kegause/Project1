<?php
//Get the data from the client side HTML form 
    $uName1 = $_POST['uName'];          // get the user name from the form field uName                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
    $pw1 = $_POST['pw'];                        // get the pw from the form field pw
//GLOBAL VARIABLES
   $fName; $lName;   $conID;    $db;
//Functions
    function openDatabase(&$conID,  &$db){   //to create a handle $conID for the database
        $host = "localhost"; $db = "ACM8062";  $usr = "root";  $pw ="";
        $conID = new mysqli($host, $usr, $pw, $db);
        if ($conID->connect_error) {
            die("Connection failed: " . $conID->connect_error);
        } 
    }
    function pwOK($conID, $uName1, $pw1, &$fName, &$lName){
        $SQL = " SELECT * FROM members";
        // the given password is encrypted before matching with the password in database
        // make sure the column names in the DB table are userName and password
        $SQL = $SQL . " WHERE userName = '$uName1' AND password = sha1('$pw1')";
        $result = $conID->query($SQL);
        if (!$result) { 
            die( "Query Error: " .$SQL. " :" .$conID->connect_error);  // insecure output
        } else {
            $row = $result -> fetch_array();
            if (!$row){  // if the row is empty, user name, password pair is wrong
                return false;
            }  else {
                $fName= $row['firstName'];
                $lName = $row['lastName'];
                $result->close();
                return true;
            }
        }
        return false; 
    }
// MAIN
openDatabase($conID, $db);
if (pwOK($conID,$uName1,$pw1,$fName, $lName)) {    //check password and if ok gets first name and last name    
    echo "<h1> Welcome ". $fName . "  . $lName   . substr($db,3) </h1>";
} else {
    echo "<h1> User name or password is wrong- Try again <h1>"; 
}
$conID->close();        
?>  