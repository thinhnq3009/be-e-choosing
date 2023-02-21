<?php


include "../connect.php";


try {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $data = json_decode(file_get_contents("php://input"));

        $data = $data->params->u;

        $sql = 'SELECT * FROM users WHERE username = "' . $data . '";';

        $result = mysqli_query($conn, $sql);

        // Nếu tồn tại bản ghi thõa mãn
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $response = array(
                'message' => 'Username has existed',
                'value' => true
            );
        } else {
            $response = array(
                'message' => 'Username does not exist',
                'value' => false
            );
        }

        echo json_encode($response);
    }

    $conn->close();
} catch (Exception $e) {
    echo json_encode(array("message" => "Error: " . $e->getMessage()));
}
