<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbName = "chatlog";

    try {
        /**connection to the chat log server */
        $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /**getting values from query */
        $un = $_GET['un'];
        $pw = $_GET['pw'];
        $em = $_GET['em'];
        $fn = $_GET['fn']; 
        $ln = $_GET['ln'];

        /**checks if all fields are filled out and returns what field is empty */
        if($un == null){
            print "please enter a username!";
        }
        elseif($pw == null){
            print "please enter a password!";
        }
        elseif($em == null){
            print "please enter a email!";
        }
        elseif($fn == null){
            print "please enter a first name!";
        }
        elseif($ln == null){
            print "please enter a last name!";
        }
        else{

            /**checks to see if the username already exists */
            $userNameExists = "SELECT username FROM users WHERE username = '$un'";
            $query = $conn -> query($userNameExists);
            $query = $query -> fetch();

            if($query != null){
                if($query[0] == $un){
                    print "user already exists";
                }
            }
            /**if it doesn't exist, add username to the database */
            else{
                /**inserting new user details into database */
                $insertUser = "INSERT INTO users (username, password, email, firstName, lastName) VALUES ('$un', '$pw', '$em', '$fn', '$ln')";

                /**sending to database */
                $result = $conn -> exec($insertUser);
                /**check to see if SQL was sucessfull */
                if($result != null){
                    print "sucessfully added user!";
                }
                else{
                    print "Error adding user!";
                }
            }
        }
    }
    /**if connection to database fails (if it does then sad) */
    catch(PDOException $e) {
        echo "Connection Failed: " . $e->getMessage();
    }

?>