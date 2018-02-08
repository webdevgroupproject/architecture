<?php
//define the number of rows to return per page
define("ROW_PER_PAGE",4);
?>
<?php
$searchQuery = filter_has_var(INPUT_GET, 'searchQuery') ? $_GET['searchQuery'] : null;
$searchQuery = filter_var($searchQuery, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
$citySearch = filter_has_var(INPUT_GET, 'citySearch') ? $_GET['citySearch'] : null;
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
$dbConn = databaseConn::getConnection();
$userType = checkUserType();
$pro = checkProStatus();
if (isset($citySearch)){
    $eventSQL = "select *
             from bp_events
             WHERE eventCity = '$citySearch'
             order by eventDate ASC";
}elseif (isset($searchQuery)){
    $eventSQL = "select *
             from bp_events
             WHERE eventName LIKE '%$searchQuery%'
             order by eventDate ASC";
}
$getCity = $dbConn->prepare('select DISTINCT eventCity From bp_events ORDER BY eventCity');
$getCity->execute();
$citys = $getCity->fetchAll();
//main html not related to the result set
echo "
<h1>Community events</h1>
<div class='filterBar'>";

if ($userType == "admin" || $pro == "1"){
    echo "<a href='addEventForm.php' class='button' id='addEventButton'>Add an event</a>";
}else if (isset($_SESSION['username'])){

    echo"<div style='float: left; width: 20%'>
            <p><a href='#'>Upgrade to pro</a> to create your own event</p>
        </div>";
}else{
    echo "<div style='float: left; width: 20%'>
            <p><a href='login.php'>log in</a> to register for events</p>
        </div>";

};
echo"<form id='orderEventsForm' action='eventSearchResults.php'>
<select name=\"citySearch\" id=\"cityDropdown\" class='dropdown'>
<option>Search by city</option>";
foreach ($citys as $city){
    echo"<option>".$city["eventCity"]."</option>";
}echo"
</select>
</form>
<form class=\"search-box\" action='eventSearchResults.php' method='get'>
            <input type=\"text\" name='searchQuery' autocomplete=\"off\" placeholder=\"Search events...\" />
            <button type='submit'><i class=\"material-icons\">search</i></button>
            <div class=\"result\"></div><br>
        </form>
        <div class='clear'></div>
          </div>";


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
    $per_page_html .= "<div class='pag-links'>";
    if ($row_count > ROW_PER_PAGE){
        $per_page_html .= "<span style='margin-right: 10px;'>Pg</span>";
    }
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
                        <p>".$row['eventCity'].", $formatTime</p>
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.search-box input[type="text"]').on("keyup input", function(){
            /* Get input value on change */
            var inputVal = $(this).val();
            var resultDropdown = $(this).siblings(".result");
            if(inputVal.length){
                $.get("searchEvents.php", {term: inputVal}).done(function(data){
                    // Display the returned data in browser
                    resultDropdown.html(data);
                });
            } else{
                resultDropdown.empty();
            }
        });

        // Set search input value on click of result item
        $(document).on("click", ".result p", function(){
            $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
            $(this).parent(".result").empty();
        });
    });
</script>
<?php

echo makePageFooter();
?>
