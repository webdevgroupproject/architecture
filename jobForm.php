<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Create account");
echo makeHeader();
?>
<html>
  <head>
    <link rel="stylesheet"  type="text/css" href="css/style.css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css"
    rel="stylesheet" type="text/css" />
  </head>
<body>
    <!--<div class="formwrapper">-->
      <br>
      <br>
      <h1>Job Application Form</h1>
      <br>
      <div class="form-container">
          <form method="post" class="login-form" action="jobFormAction.php">

              <!-- Job Description Section -->
              <fieldset>

                  <legend><h3>Describe the Job</h3></legend>

                  <label>Name your job posting: </label>
                  <input type="text" name="jobName" class="form-control block" placeholder="Example: Housing Extension Request"
                         data-validation-length="min4 data" data-validation="required">

                  <label>Describe the work to be done: </label>
                  <input type="text" name="workDesc" class="form-control block" placeholder="Use this area to provide details about your project"
                         data-validation="length alphanumeric" data-validation-length="min4 data" data-validation="required">

                  <label>Job Location: </label>
                  <input type="text" name="jobLocation" class="form-control block" placeholder="Example: Newcastle upon Tyne"
                         data-validation="length alphanumeric" data-validation-length="min4 data" data-validation="required">

              </fieldset>

              <!-- Rate and Availability Section -->
              <fieldset>
                  <legend><h3>Rates and Availability</h3></legend>

                  <label>How would you like to pay: </label>
                  <input type="text" name="payMethod" class="form-control block" placeholder="Example: Weekly"
                         data-validation="length alphanumeric" data-validation-length="min4 data" data-validation="required">

                  <label>Budget: </label>
                  <select name="budgetType">
                    <option value="fixedPrice">Fixed Price</option>
                    <option value="hourlyProject">Hourly Project</option>
                  </select>
                  <br>
                  <br>

                  <label>Job Duration: </label>
                  <input type="text" name="jobDuration" class="form-control block" placeholder="Example: 6 Months"
                         data-validation-length="min4 data" data-validation="required">

              </fieldset>

              <!-- Dates and Deadlinesn-->
              <fieldset>
                  <legend><h3>Dates and Deadlines</h3></legend>

                  <label>Start Date: </label>
                  <input type="date" name="startDate" class="form-control block" placeholder="Example: 06/11/18"
                         data-validation="required" min="2018-02-07">

                  <label>Is this date flexible? </label>
                  <select name="startDateFlex">
                    <option value="dateFlexYes">Yes</option>
                    <option value="dateFlexNo">No</option>
                  </select>
                  <br>
                  <br>

                  <label>End Date: </label>
                  <input type="date" name="endDate" class="form-control block" placeholder="Example: 20/02/19"
                         data-validation="required" min="2018-02-07">

                  <label>Is this date flexible? </label>
                  <select name="endDateFlex">
                    <option value="dateFlexYes">Yes</option>
                    <option value="dateFlexNo">No</option>
                  </select>

              </fieldset>

              <!-- Submit Button -->
              <div class="submit-wrap">
                  <br>
                  <input type="submit" value="Post Job" class="button">
              </div>
          </form>
      </div>
    <!--</div>-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
    <script>
        $.validate({
        form : ".login-form"

    });
    </script>
</body>
</html>
<?php
echo makePageFooter();
?>
