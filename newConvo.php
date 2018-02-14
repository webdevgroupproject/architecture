<?php

require_once('scripts/functions.php');
require_once ('classes/databaseConn.php');
echo startSession();


$userId = $_SESSION['userId'];
$username = filter_has_var(INPUT_GET, 'newConversation') ? $_GET['newConversation'] : null;
$other = filter_has_var(INPUT_GET, 'convoListing') ? $_GET['convoListing'] : null;

if (isset($username)) {
  $dbConn = databaseConn::getConnection();
  $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $SQL = "SELECT *
           FROM bp_user
           WHERE forename LIKE '%$username%'
           OR surname LIKE '%$username%'";
           echo "$SQL";

  if ($Stmt = $dbConn->query($SQL)) {
    $row = $Stmt->fetch(PDO::FETCH_OBJ);{
      $secUserID = $row->userId;
    }
  }
} elseif (isset($other)) {
  $secUserID = $other;
}

if (empty($secUserID)) {
    echo "<p>please enter a name</p>";
} else {

    try {
        $dbConn = databaseConn::getConnection();
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $addConvoSql = "    INSERT INTO bp_conversation (startUserID, secUserID, time)
                        VALUES ('$userId', '$secUserID', now())";
        // use exec() because no results are returned
        $dbConn->exec($addConvoSql);
        header("Location: messaging.php");
    }
    catch(PDOException $e) {
        echo $addConvoSql . "<br>" . $e->getMessage();
    }

}
