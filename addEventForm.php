<?php
require_once ('scripts/functions.php');
echo startSession();
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
?>


    <br/><br/><h1>Add an event</h1>
    <div class="form-container">
        <form method="get" action="addEventAction.php" id="addEventForm">
            <fieldset>
                <legend>Where</legend>
                <label>Address line 1: </label>
                <input type="text" name="address1" class="form-control block" placeholder="Please enter the first line of the address"
                       data-validation="required">
                <label>Address line 2 (optional): </label>
                <input type="text" name="address2">
                <label>City: </label>
                <input type="text" name="city" class="form-control block" placeholder="Please enter the first line of the address"
                       data-validation="required">
                <label>Postcode: </label><br>
                <input style="width: 150px;" type="text" name="postcode" class="form-control block" placeholder="Please enter the first line of the address"
                       data-validation="required"><br>
            </fieldset>
            <fieldset>
                <legend>When</legend>
                <label>Date: </label><br>
                <input style="width: 150px;" type="date" name="date" class="form-control block" placeholder="Please enter the first line of the address"
                       data-validation="required" data-validation-help="Please enter a username"><br>
                <label>Time: </label><br>
                <input style="width: 150px;" type="time" name="time" class="form-control block" placeholder="Please enter the first line of the address"
                       data-validation="required"><br>
            </fieldset>
            <fieldset>
                <legend>Additional info</legend>
                <label>Event name: </label>
                <input type="text" name="name" class="form-control block" placeholder="Please enter the first line of the address"
                       data-validation="required">
                <label>Spaces: </label><br>
                <input style="width: 150px;" type="number" name="spaces" class="form-control block" placeholder="Please enter the first line of the address"
                       data-validation="required"><br>
                <label>Event Information: </label>
                <textarea style="max-width: 100%; width: 100%; margin-bottom: 1em;" name="info" id='info' class="form-control block" placeholder="Please enter the first line of the address"
                          data-validation="required"></textarea>
                <label>Image: </label>
                <input type="file" name="image">
            </fieldset>
            <div class="submit-wrap">
            <input type="submit" value="Add event" class="button">
            </div>
        </form>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
    <script>
        $.validate({
            form : "#addEventForm"

        });
    </script>

<?php
echo makePageFooter();
?>