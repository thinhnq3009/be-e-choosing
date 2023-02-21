<?php


include "../connect.php";


try {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $data = json_decode(file_get_contents("php://input"));

        $data = $data->params->token;

        $sql = 'SELECT * FROM users WHERE token = "' . $data . '";';


        $result = $conn->query($sql);
        $response = array();
        $response = $result->fetch_all(MYSQLI_ASSOC);

        if (count($response) == 1) {

            $response = $response[0];

            // Update mới lại token 
            $newToken = hash("sha256", $response['username'] . time());
            $response['token'] = $newToken;
            $id = $response['id'];

            $sql = "UPDATE `users` SET token = '$newToken' WHERE id = $id";

            if (mysqli_query($conn, $sql)) {
                echo json_encode($response);
            } else {
                echo json_encode(array("error" => "Can't update token. Validation failed"));
            }
        } else if (count($response) == 0) {
            echo json_encode(array("error" => "Validation Failed"));
        }
    }

    $conn->close();
} catch (Exception $e) {
    echo json_encode(array("message" => "Error: " . $e->getMessage()));
}
