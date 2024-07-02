```php
<?php
    // Establish database connection
    $conn = mysqli_connect("localhost", "root", "", "test") or die("Connection failed");

    // Check the type of request
    if ($_POST['type'] == "") {
        // If type is empty, fetch countries
        $sql = "SELECT * FROM country_tb";
        // Query to select all countries from the database
        $query = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

        $str = ""; // Initialize an empty string to store HTML options

        // Loop through the query result and generate HTML options for countries
        while ($row = mysqli_fetch_assoc($query)) {
            // Append each country as an option to the string
            $str .= "<option value='{$row['cid']}'>{$row['cname']}</option>";
        }
    } else if ($_POST['type'] == "stateData") {
        // If type is stateData, fetch states based on the selected country
        $sql = "SELECT * FROM state_tb WHERE country = {$_POST['id']}";
        // Query to select states based on the selected country ID
        $query = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

        $str = ""; // Initialize an empty string to store HTML options

        // Loop through the query result and generate HTML options for states
        while ($row = mysqli_fetch_assoc($query)) {
            // Append each state as an option to the string
            $str .= "<option value='{$row['sid']}'>{$row['sname']}</option>";
        }
    }

    // Output the generated HTML options
    echo $str;
?>