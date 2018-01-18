<?php
require_once ('scripts/functions.php');
echo startSession();
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
?>


    <br/><br/><h1>Add an event</h1>
    <div class="form-container">
        <form method="get" action="addEventAction.php">
            <fieldset>
                <legend>Where</legend>
                <label>Address line 1: </label>
                <input type="text" name="address1">
                <label>Address line 2 (optional): </label>
                <input type="text" name="address2">
                <label>City: </label>
                <input type="text" name="city">
                <label>Postcode: </label><br>
                <input style="width: 150px;" type="text" name="postcode"><br>
            </fieldset>
            <fieldset>
                <legend>When</legend>
                <label>Date: </label><br>
                <input style="width: 150px;" type="date" name="date"><br>
                <label>Time: </label><br>
                <input style="width: 150px;" type="time" name="time"><br>
            </fieldset>
            <fieldset>
                <legend>Additional info</legend>
                <label>Event name: </label>
                <input type="text" name="name">
                <label>Spaces: </label><br>
                <input style="width: 150px;" type="number" name="spaces"><br>
                <label>Event Information: </label>
                <textarea style="max-width: 100%; width: 100%; margin-bottom: 1em;" name="info" id='info'></textarea>
                <label>Image: </label>
                <input type="file" name="image">
            </fieldset>
            <div class="submit-wrap">
            <input type="submit" value="Add event" class="button">
            </div>
        </form>
    </div>


<?php
echo makePageFooter();
?>