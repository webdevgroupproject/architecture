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
              <h2>Describe the Job</h2>

              <label>Name your job posting: </label>
              <input type="text" name="jobName" class="form-control block" placeholder="Example: Housing Extension Request"
                     data-validation="length alphanumeric" data-validation-length="min4 data" data-validation="required">

              <label>Describe the work to be done: </label>
              <input type="text" name="workDesc" class="form-control block" placeholder="Use this area to provide details about your project"
                     data-validation="length alphanumeric" data-validation-length="min4 data" data-validation="required">

              <label>Job Location: </label>
              <input type="text" name="jobLocation" class="form-control block" placeholder="Example: Newcastle upon Tyne"
                     data-validation="length alphanumeric" data-validation-length="min4 data" data-validation="required">

              <!-- Rate and Availability Section -->
              <h2>Rate and Availability</h2>

              <label>How would you like to pay: </label>
              <input type="text" name="payMethod" class="form-control block" placeholder="Optional: Enter your organisation name"
                     data-validation="length alphanumeric" data-validation-length="min4 data" data-validation="required">

              <label>Budget: </label>
              <select name="budgetType">
                <option value="fixedPrice">Fixed Price</option>
                <option value="hourlyProject">Hourly Project</option>
              </select>

              <label>Job Duration: </label>
              <input type="text" name="jobDuration" class="form-control block" placeholder="Example: 6 Months"
                     data-validation="length alphanumeric" data-validation-length="min4 data" data-validation="required">

              <!-- Dates and Deadlinesn-->
              <h2>Dates and Deadlines</h2>

              <label>Start Date: </label>
              <input type="date" name="startDate" class="form-control block" placeholder="Example: 06/11/18"
                     data-validation="length alphanumeric" data-validation-length="min4 data" data-validation="required">

              <label>Is this date flexible? </label>
              <select name="startDateFlex">
                <option value="dateFlexYes">Yes</option>
                <option value="dateFlexNo">No</option>
              </select>

              <label>End Date: </label>
              <input type="date" name="endDate" class="form-control block" placeholder="Example: 20/02/19"
                     data-validation="length alphanumeric" data-validation-length="min4 data" data-validation="required">

              <label>Is this date flexible? </label>
              <select name="endDateFlex">
                <option value="dateFlexYes">Yes</option>
                <option value="dateFlexNo">No</option>
              </select>

              <!-- Submit Button -->
              <div class="submit-wrap">
                  <br>
                  <input type="submit" value="Post Job" class="button">
              </div>
          </form>
      </div>
    <!--</div>-->
</body>
</html>
<?php
echo makePageFooter();
?>
