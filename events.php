<?php
//define the number of rows to return per page
define("ROW_PER_PAGE",4);
?>
<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
$dbConn = databaseConn::getConnection();
$userType = checkUserType();
$searchCitySQL = 'SELECT DISTINCT eventCity
                  FROM bp_events';
$eventSQL = 'select *
             from bp_events
             order by eventDate ASC';

//main html not related to the result set
echo "
<h1>Community events</h1>
<div class='filterBar'>
    <form id='orderEventsForm' action='#' onchange=\"sortBy(this . value)\">
		    <label>Choose a City: </label>
			<select class='dropdown' name=\"searchByCity\">
			    <option value='none' selected>Choose a city</option>";
foreach ($dbConn->query($searchCitySQL) as $cityRow) {
    echo       "<option value='".$cityRow['eventCity']."'>".$cityRow['eventCity']."</option>";
}
echo"</select>
    </form>";
if ($userType == "admin"){
    echo "<a href='addEventForm.php' class='button' id='addEventButton'>Add an event</a> <div class='clear'></div> ";
}else{
    echo"<div class='clear'></div>";
};
//end filterbar
echo "</div>";


// Pagination Code starts
$per_page_html = '';
$page = 1;
$start=0;
if(!empty($_POST["page"])) {
    $page = $_POST["page"];
    $start=($page-1) * ROW_PER_PAGE;
}
$limit=" limit " . $start . "," . ROW_PER_PAGE;
$pagination_statement = $dbConn->prepare($eventSQL);
$pagination_statement->execute();

$row_count = $pagination_statement->rowCount();
//if there are results returned
if(!empty($row_count)){
    //add html to display the pagination links in a div to a variable
    $per_page_html .= "<div class='pag-links' '><span style='margin-right: 10px;'>Pg</span>";
    //divide the number of rows by the number of rows per page to get the page count
    $page_count=ceil($row_count/ROW_PER_PAGE);
    //if the page count is bigger than 1 show the pagination links
    if($page_count>1) {
        for($i=1;$i<=$page_count;$i++){
            if($i==$page){
                $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="pag-button pag-button-current" />';
            } else {
                $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="pag-button" />';
            }
        }
    }
    $per_page_html .= "</div>";
}

$query = $eventSQL.$limit;
$pdo_statement = $dbConn->prepare($query);
$pdo_statement->execute();
$result = $pdo_statement->fetchAll();

//display results
echo"<div class='result-set'>
        <div class=\"images-container\">";
if(!empty($result)) {
    foreach($result as $row) {
        $date = $row['eventDate'];
        $dateString = strtotime($date);
        $formatMonth = date("M", $dateString);
        $formatDay = date("d", $dateString);
        $eventImage = $row['eventImage'];
        $time = $row['eventTime'];
        $timeString = strtotime($time);
        $formatTime = date("h:ia", $timeString);

        echo"
                <div class='event-contain'>
                    <div class='event-date-contain'><p>$formatMonth</p><p>$formatDay</p></div>
                    <div class='event-img-contain'>
                        <img src=\"images/".$eventImage."\" alt = \"Event image\" >
                    </div > 
                    <div class='event-info-contain'>
                        <h2>".$row['eventName']."</h2>
                        <p>".$row['eventPlace'].", $formatTime</p>
                        <a class=\"button\" href=\"eventPage.php?eventid=" .$row['eventId']. "\"> Find out more </a >";
        if ($userType == "admin") {
            echo       "<a style = 'right: 0;' href = 'ManageEventForm.php?eventid=" .$row['eventId']. "' class='button'>Manage</a>";
        }
        echo"       </div>
            <div class='media-contain'>
                <a href='#'><div class='media-box'><img src=\"images/facebook.png\"></div></a>
                <a href='#'><div class='media-box'><img src=\"images/twitter.png\"></div></a>
                <a href='#'><div class='media-box'><img src=\"images/youtube.png\"></div></a>
            </div>         
        </div>
        ";

    }
}

echo"</div>
</div>
<form name='frmSearch' action='' method='post' class=\"pag-form\">
        $per_page_html
    </form>";?>

<script>
    $(document).ready(function(){
        $(".dropdown").change(function(){
            $("#orderEventsForm").submit();
        });
    });
</script>
<?php

echo makePageFooter();
?>
