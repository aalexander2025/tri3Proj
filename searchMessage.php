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
        $st = $_GET['st'];
        $type = $_GET['type'];
        /**if checking messages to user */
        if($type == "to"){    
        /**get to User, from User, and content */
            $searchUser = "SELECT messagerecipients.toUserId as toUserId, messages.fromUserId, messages.content FROM users JOIN messagerecipients ON users.userId = messagerecipients.toUserId AND users.username = '$st' JOIN messages ON messages.messageId = messagerecipients.messageId";
            $result = $conn -> query($searchUser);
        }
        /**if checking messages from user */
        if($type == "from"){    
            /**get to User, from User, and content */
            $searchUser = "SELECT messagerecipients.toUserId, messages.fromUserId, messages.content FROM users JOIN messages ON users.userId = messages.fromUserId AND users.username = '$st' JOIN messagerecipients ON messages.messageId = messagerecipients.messageId";
            $result = $conn -> query($searchUser);
        }
        /**run through each row */



        print "<style> table, th, td {border: none;border-spacing: 2px;} </style>";

        print "<table><tr><th>To:</th><th>From:</th><th>Message:</th></tr>";

        foreach($result as $r){
            /**select usernames from userId */
            $findUserTo = "SELECT username FROM users WHERE userId = '$r[toUserId]'";
            $sqlTo = $conn -> query($findUserTo);
            $sqlTo = $sqlTo -> fetch();

            /**checks to see if sender exists */
            if($r['fromUserId'] != null){
                $findUserFrom = "SELECT username FROM users WHERE userId = '$r[fromUserId]'";
                $sqlFrom = $conn -> query($findUserFrom);
                $sqlFrom = $sqlFrom -> fetch();
                $sqlFromUser = $sqlFrom[0];   
            }
            /**if it doesn't exist then it returns anonymous */
            else if($r['fromUserId'] == null){
                $sqlFromUser = "anonymous";       
            }
            /**implode was returning the name twice so I just used a seperate variable */
            $sqlToUser = $sqlTo[0];
            $content = $r['content'];
            /**print out the content! */

            print "<tr>";

            print "<td> $sqlToUser </td>";
            print "<td> $sqlFromUser </td>";    
            print "<td> $content </td>";  

            print "</tr>";
            
            
        }  
        
        print "</table>";

    }
    /**if connection to database fails (if it does then sad) */
    catch(PDOException $e) {
        echo "Connection Failed: " . $e->getMessage();
    }
?>