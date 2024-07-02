<?php
    // Establish database connection
	$conn = mysqli_connect("localhost", "root", "", "test") or die("Connection failed");

    // Get the selected state ID from the POST request
    $state = $_POST['stateId'];

    // Query to select divisions based on the selected state
    $query = "SELECT * FROM `division` WHERE `s_id` = '$state'";
    $result = mysqli_query($conn, $query);

    $data = []; // Initialize an array to store division data

    // Check if the query was successful
    if ($result) {
        // Loop through the query result and fetch division data
        while ($row = mysqli_fetch_array($result)) {
            // Get division ID and name
            $d_id = $row['d_id'];
            $d_name = $row['d_name'];

            // Store division data in an array
            $data[] = array(
                'division_id' => $d_id,
                'division_name' => $d_name,
            );
        }
    }

    // Encode the division data in JSON format and send it as response
    echo json_encode($data);
?>
