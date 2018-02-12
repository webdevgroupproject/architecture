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

        $sql = "SELECT * FROM bp_user WHERE forename LIKE :term OR surname LIKE :term";

        $stmt = $dbConn->prepare($sql);
        $term = '%' . $_REQUEST['term'] . '%';
        // bind parameters to statement
        $stmt->bindParam(':term', $term);
        // execute the prepared statement
        $stmt->execute();
        if($stmt->rowCount() > 0){
            echo "<ul>";
            while($row = $stmt->fetch()){

                echo "<li value=". $row['userId'] .">" . $row['forename'] ." ". $row['surname'] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No matches found</p>";
        }
    }
} catch(PDOException $e){
    die("ERROR: Could not execute $sql. " . $e->getMessage());
}

// Close connection
unset($dbConn);

?>
