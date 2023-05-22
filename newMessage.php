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
        $to = $_GET['to'];
        $fm = $_GET['fm'];  
        $ta = $_GET['ta'];

        /**check if inputs aren't blank */
        if($to != "" && $fm != ""){
            
            /**find userId with a username of $to */
            $findTo = "SELECT userId FROM users WHERE username = '$to'";
            $idTo = $conn -> query($findTo);
            $idTo = $idTo -> fetch();
            
            /**find userId with a username of $to */
            $findFrom = "SELECT userId FROM users WHERE username = '$fm'";
            $idFrom = $conn -> query($findFrom);
            $idFrom = $idFrom -> fetch();

            /**check if users exist */
            if($idTo == null){
                print "the user " . "$to" . " doesn't exist! <br>";
            }
            if($idFrom == null){
                print "the user " . "$fm" . " doesn't exist! <br>";
            }
            /**if all exists, then yayayay!!! we move on to INSERT now*/
            elseif($idTo != null && $idFrom != null){
                /**if content is empty, put placeholder text */
                if($ta == ""){
                    $ta = "Empty message!";
                }
                /**insert content from userId */
                $insContent = "INSERT INTO messages (content, fromUserId) 
                VALUES ('$ta', '$idFrom[0]')";
                $execMessages = $conn -> exec($insContent);
                /**get last inserted id from messages */
                $messageId = $conn -> lastInsertId();
                /**insert message id and toId into recipients */
                $insRecipiant = "INSERT INTO messagerecipients (messageId, toUserId) 
                VALUES ('$messageId', '$idTo[0]')";
                $execRec = $conn -> exec($insRecipiant);
                /**return sucess if all works correctly (yayayyayayy!!!) */
                print "message sent successfully!";
            }
        } 
    }
    /**if connection to database fails (if it does then sad) */
    catch(PDOException $e) {
        echo "Connection Failed: " . $e->getMessage();
    }

?>