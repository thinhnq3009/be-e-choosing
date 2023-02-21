<?php

include '../connect.php';

$username = $_POST["username"];
$password = $_POST["password"];
$password = hash('sha256', $password);
$fullname = $_POST["fullname"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$submit = $_POST["submit"];

if (isset($submit)) {

    // Step 3: Insert data into users table
    $sql = "INSERT INTO users (username, password, fullname, email, phone_number) 
VALUES ('$username', '$password', '$fullname','$email', '$phone')";
    if (mysqli_query($conn, $sql)) {
        // Step 4: Return success message and status code

        $response = [
            "status_code" => 201,
            "status" => "success",
            "message" => "Registration successful"
        ];
    } else {
        // Return error message and status code if insertion failed

        $response = [
            "status_code" => 400,
            "status" => "error",
            "message" => "Registration failed"
        ];
    }

    // Return response in JSON format
    echo json_encode($response);

    // Close database connection
    mysqli_close($conn);
}
