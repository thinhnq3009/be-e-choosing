<?php


include "../connect.php";


try {
    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        $data = json_decode(file_get_contents("php://input"));
        $submission_id = $data->params->submission_id;

        $sql = "UPDATE submissions SET end_time = NOW() WHERE id = $submission_id";


        if (mysqli_query($conn, $sql)) {
            $sql = "SELECT * FROM submissions WHERE id = $submission_id";

            $result = mysqli_query($conn, $sql);

            $response = [];

            if (isset($result)) {
                $data = [];
                foreach ($result as $row) {
                    $data[] = $row;
                }

                if (count($data) > 0) {
                    echo json_encode($data[0]);
                } else {
                    echo json_encode(array("error" => "No Quiz found."));
                }
            } else {
                $response = [
                    "error" => "Error executing"
                ];
                echo json_encode($response);
            }
        } else {
            echo json_encode(array("error" => "Update fails"));
        }
    }

    $conn->close();
} catch (Exception $e) {
    echo json_encode(array("message" => "Error: " . $e->getMessage()));
}
