<?php
//Ross Brown
define("ROW_PER_PAGE",5);
?>
<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
$userType = checkUserType();
$userId = $_SESSION['userId'];
$searchQuery = filter_has_var(INPUT_GET, 'searchQuery') ? $_GET['searchQuery'] : null;
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
$dbConn = databaseConn::getConnection();
$sql = "select *
        from bp_thread 
        left join bp_user 
        on bp_thread.userId=bp_user.userId
        WHERE bp_thread.threadTitle LIKE '%$searchQuery%'
        order by datePosted DESC, timePosted DESC";

echo "<h1>Discussion board</h1>";
echo "
      <div class='filterBar'>
        <div class=\"postThread\" id='postThread' style='display: none; float: left;'>
            <div class=\"form-container\">";
if(isset($_SESSION['logged-in']) && $_SESSION['logged-in'] == true){
    echo"
                <form method=\"get\" action=\"addThread.php\" id='postThreadForm'>
                    <label for='title'>Thread title: </label>
                    <input type=\"text\" name=\"threadTitle\" id='title' class=\"form-control block\" data-validation=\"required\" placeholder=\"Please enter a title\">
                    <label for='postThread'>Thread information</label><br/>
                    <textarea class=\"form-control block\" style=\"max-width: 100%; width: 100%;\" name=\"threadInfo\" id='postThread' data-validation=\"required\" placeholder=\"Please enter some information\"></textarea>
                    <input type=\"submit\" value=\"Post\" class=\"button\">
                    <a class='button' onclick='toggleForm()' id='closeFormButton'>Hide</a>
                </form>
            </div> 
             
        </div>
        <a class='button' onclick='toggleForm()' id='openFormButton' style='padding: 1em; margin: 0; float: left;'>Start a thread</a>
        <form class=\"search-box\">
        <input type=\"text\" name='searchQuery' autocomplete=\"off\" placeholder=\"Search message boards...\" />
        <button type='submit'><i class=\"material-icons\">search</i></button>
        <div class=\"result\"></div><br>
        
    </form>  
      ";
}
else{
    echo "
            </div>  
        </div>
        <div style='float: left; width: 40%'>
            <p><a href='login.php'>Log in</a> to post a thread</p>
        </div>
        <form class=\"search-box\" action='forumSearchResults.php' method='get'>
            <input type=\"text\" name='searchQuery' autocomplete=\"off\" placeholder=\"Search message boards...\" />
            <button type='submit'><i class=\"material-icons\">search</i></button>
            <div class=\"result\"></div><br>
        </form> 
      ";
};
echo"
        <div class='clear'></div>
      </div>";
/* Pagination Code starts (http://phppot.com/php/php-search-and-pagination-using-pdo/) */
$per_page_html = '';
$page = 1;
$start=0;
if(!empty($_POST["page"])) {
    $page = $_POST["page"];
    $start=($page-1) * ROW_PER_PAGE;
}
$limit=" limit " . $start . "," . ROW_PER_PAGE;
$pagination_statement = $dbConn->prepare($sql);
$pagination_statement->execute();
$row_count = $pagination_statement->rowCount();
//if there are results returned
if(!empty($row_count)){
    //add html to display the pagination links in a div to a variable
    $per_page_html .= "<div class='pag-links'>";
    if ($row_count > ROW_PER_PAGE){
        $per_page_html .= "<span style='margin-right: 10px;'>Page</span>";
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
$query = $sql.$limit;
$pdo_statement = $dbConn->prepare($query);
$pdo_statement->execute();
$result = $pdo_statement->fetchAll();
//display results
echo"
      <div class='result-set'>";
if(!empty($result)) {
    foreach($result as $row) {
        $forumId = $row['threadId'];
        $date = $row['datePosted'];
        $dateString = strtotime($date);
        $formatDate = date("d/m/Y", $dateString);
        $sqlCount = "SELECT count(*) 
                     FROM bp_thread_message
                     WHERE threadID = '$forumId' ";
        $result = $dbConn->prepare($sqlCount);
        $result->execute();
        $number_of_rows = $result->fetchColumn();
        echo"
        <div class=\"thread\">      
            <div class='thread-info'>
                <img style='margin-right: 20px;' src=\"Images/house.png\">
                <a href=\"thread.php?threadId=$forumId\">
                    <h2>".$row['threadTitle']."</h2>
                </a>
                <p>".$row['threadInfo']."</p> 
                <span><a href='#'> ".$row['username']."</a> Posted: ".$formatDate ."";
        if ($userType == "admin" || $userId == $row['userId']){
            echo"
                <a href='deleteThreadAction.php?threadId=$forumId'>Delete</a>";
        }
        echo"   </span>
            </div> 
            <div class=\"replyInfoBox\">";
        if ($number_of_rows == 1){
            echo "
                <p>$number_of_rows reply</p>";
        }
        else{
            echo "
                <p>$number_of_rows replies</p>";
        };
        echo"
            </div>
            <div class='clear'></div>
        </div>";
    };
}
echo" </div>
      <form name='frmSearch' action='#' method='post' class=\"pag-form\">
        $per_page_html
      </form>";
?>
<script>
    function toggleForm() {
        var toggleElement = document.getElementById("postThread");
        var openFormButton = document.getElementById("openFormButton");
        if (toggleElement.style.display === "none") {
            toggleElement.style.display = "block";
            openFormButton.style.display = "none";
        } else {
            toggleElement.style.display = "none";
            openFormButton.style.display = "inline-block";
        }
    }
</script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
    <script>
        $.validate({
            form : "#postThreadForm"

        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.search-box input[type="text"]').on("keyup input", function(){
                /* Get input value on change */
                var inputVal = $(this).val();
                var resultDropdown = $(this).siblings(".result");
                if(inputVal.length){
                    $.get("searchForum.php", {term: inputVal}).done(function(data){
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