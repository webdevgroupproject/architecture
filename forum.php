<?php
define("ROW_PER_PAGE",5);
?>
<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
$dbConn = databaseConn::getConnection();

        $sql = 'select *
             from bp_thread 
             left join bp_user 
             on bp_thread.userId=bp_user.userId
             order by datePosted DESC';

        echo "<h1>Discussion board</h1>";
        if(isset($_SESSION['logged-in']) && $_SESSION['logged-in'] == true){
            echo "
         <div class='filterBar'>
          <div class=\"postThread\" id='postThread' style='display: none'>
            <div class=\"form-container\">
                <form method=\"get\" action=\"addThread.php\" id='postThreadForm'>
                    <label for='title'>Thread title: </label>
                    <input type=\"text\" name=\"threadTitle\" id='title'>
                    <label for='postThread'>Thread information</label><br/>
                    <textarea style=\"max-width: 100%; width: 100%;\" name=\"threadInfo\" id='postThread'></textarea>
                    <input type=\"submit\" value=\"Post\" class=\"button\">
                    <a class='button' onclick='toggleForm()' id='closeFormButton'>Hide</a>
                </form>
                
            </div>  
          </div>
          <a class='button' onclick='toggleForm()' id='openFormButton' style='padding: 1em; margin: 0; float: left;'>Start a thread</a>
          <div class='clear'></div>
          </div>";
        }
        else{
            echo "sign in to post a thread";
        };

        /* Pagination Code starts */
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
            //display the pagination links
            $per_page_html .= "<div class='pag-links' '><span style='margin-right: 10px;'>Pg</span>";
            $page_count=ceil($row_count/ROW_PER_PAGE);
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
        echo"<div class='result-set'>";
        if(!empty($result)) {
            foreach($result as $row) {
                $forumId = $row['threadId'];
                $sqlCount = "SELECT count(*) FROM bp_thread_message
                 WHERE threadMessId = '$forumId' ";
                $result = $dbConn->prepare($sqlCount);
                $result->execute();
                $number_of_rows = $result->fetchColumn();

                echo"<div class=\"thread\">
            
            <div class='thread-info'>
                <img src=\"Images/default_user.png\">
                <a href=\"thread.php?threadId=$forumId\">
                <h2>".$row['threadTitle']."</h2>
            </a>
             <p>".$row['threadInfo']."</p> 
             <span>".$row['username']." | Posted: ".$row['datePosted']."</span>
            </div>
             
            <div class=\"replyInfoBox\">";
                if ($number_of_rows == 1){
                    echo "<p>$number_of_rows reply</p>";
                }
                else{
                    echo "<p>$number_of_rows replys</p>";
                };

                echo"</div>
        
        <div class='clear'></div>
        </div>";

            }
        }

    echo"</div>
    <form name='frmSearch' action='' method='post' class=\"pag-form\">
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

<?php
echo makePageFooter();
?>