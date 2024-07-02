<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Dynamic Dependent Select Box</title>
  <link rel="stylesheet" href="css/style.css"> </head>

<body>
  <div id="main">
    <h1>Dynamic Dependent Select Box in<br> PHP & jQuery Ajax</h1>
  </div>
  <div id="content">
    <form method=""> <label>Country : </label>
      <select id="country">
        <option value="">Select Country</option>
        </select>
      <br><br>
      <label>State : </label>
      <select id="state" onchange="next_value()">
        <option value=""></option>
        </select>
      <label>Division : </label>
      <select id="division">
        <option value=""></option>
        </select>
      <label>District : </label>
      <select id="district">
        <option value=""></option>
        </select>
    </form>
  </div>
  <script type="text/javascript" src="js/jquery.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      // Function to load data (countries or states) based on type and category ID
      function loadData(type, category_id) {
        $.ajax({
          url: "load-cs.php",  type: "POST", data: { type: type, id: category_id },
          success: function(data) {
            if (type == "stateData") {
              $("#state").html(data);  // Replace state select options with received data
            } else {
              $("#country").append(data); // Add received data (countries) to existing options
            }
          }
        });
      }

      // Load countries initially (optional, can be loaded from server-side)
      loadData();

      // Event handler for country selection change
      $("#country").on("change", function() {
        var country = $("#country").val();
        if (country != "") {
          loadData("stateData", country); // Load states based on selected country
        } else {
          $("#state").html("");  // Clear state options if no country selected
        }
      });
    });

    // Function to load divisions based on selected state (can be modified for districts)
    async function next_value() {
      var stateId = $("#state").val();
      $.ajax({
        url: "../division_get.php",  type: "POST",                data: {
          stateId: stateId           },
        success: function(data) {
          console.log(data);           // Log the received data for debugging (optional)
          var divisions = JSON.parse(data); // Parse JSON data to usable object
          if (divisions.length === 0) {
            alert("There is no division against this country");
          } else {
            $("#division").empty();  // Clear division options before populating
            divisions.forEach(function(division) {
              $("#division").append('<option value="' + division.division_id + '">' + division.division_name + '</option>');
            });
          }
        }
      });
    }
  </script>
</body>

</html>
