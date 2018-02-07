<?php
//(https://www.tutorialrepublic.com/php-tutorial/php-mysql-ajax-live-search.php)
require_once ('scripts/functions.php');
require_once ('classes/databaseConn.php');
$dbConn = databaseConn::getConnection();
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
try{

    // Set the PDO error mode to exception
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}

// Attempt search query execution
try{
    if(isset($_REQUEST['term'])){
        // create prepared statement
        $sql = "SELECT distinct username FROM bp_thread_message inner join bp_user on bp_thread_message.userId = bp_user.userId where reported = 1 ";
        $stmt = $dbConn->prepare($sql);
        $term = '%' . $_REQUEST['term'] . '%';
        // bind parameters to statement
        $stmt->bindParam(':term', $term);
        // execute the prepared statement
        $stmt->execute();
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()){
                echo "<p>" . $row['username'] . "</p>";
            }
        } else{
            echo "<p>No matches found";
        }
    }
} catch(PDOException $e){
    die("ERROR: Could not execute $sql. " . $e->getMessage());
}

// Close connection
unset($dbConn);
?>