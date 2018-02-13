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
                <label>Event name: &#9913;</label>
                <input type="text" name="name" class="form-control block" placeholder="Please enter the event name"
                       data-validation="required">
            </fieldset>
            <fieldset>
                <legend>Where</legend>
                <label>Address line 1: &#9913;</label>
                <input type="text" name="address1" class="form-control block" placeholder="Please enter the first line of the address"
                       data-validation="required">
                <label>Address line 2: </label>
                <input type="text" name="address2">
                <label>City: &#9913;</label>
                <input type="text" name="city" class="form-control block" placeholder="Please enter the city"
                       data-validation="required">
                <label>Postcode: &#9913;</label><br>
                <input style="width: 150px;" type="text" name="postcode" class="form-control block" placeholder="Enter a valid UK postcode"
                       data-validation="required"><br>
            </fieldset>
            <fieldset>
                <legend>When</legend>
                <label>Date: &#9913;</label><br>
                <input style="width: 150px;" type="date" name="date" class="form-control block" data-validation="required" data-validation-help="Please enter a date"><br>
                <label>Time: &#9913;</label><br>
                <input style="width: 150px;" type="time" name="time" class="form-control block" data-validation="required"><br>
            </fieldset>
            <fieldset>
                <legend>Additional info</legend>
                <label>Spaces: &#9913;</label><br>
                <input style="width: 150px;" type="number" name="spaces" value="1" min="1" max="1000" class="form-control block" data-validation="required"><br>
                <label>Event Information: &#9913;</label>
                <textarea style="max-width: 100%; width: 100%; margin-bottom: 1em;" name="info" id='info' class="form-control block" placeholder="Please enter some information about the event"
                          data-validation="required"></textarea>
                <label>Image: </label>
                <input style="padding: 0;" type="file" name="image">
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