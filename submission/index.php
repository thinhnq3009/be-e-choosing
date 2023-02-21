<?php


include "../connect.php";


try {

    // Phương thức POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = json_decode(file_get_contents("php://input"));
        $code = $data->params->code;
        $id = $data->params->userId;

        $sql = "SELECT * FROM `quizzes` WHERE join_code = '" . $code . "'";


        $result = mysqli_query($conn, $sql);

        $response = [];

        if (isset($result)) {
            $data = [];
            foreach ($result as $row) {
                $data[] = $row;
            }

            $data = $data[0];
            $quizId = $data['id'];
            // $sql =  "SELECT * FROM submissions WHERE submissions.end_time IS NULL AND user_id = $id AND quizz_id = $quizId;";
            $sql = "INSERT INTO `submissions`( `user_id`, `quizz_id`) VALUES ($id ,$quizId); ";


            if (mysqli_query($conn, $sql)) {


                $sql =  "SELECT (submissions.id) AS 'submission_id', quizzes.* FROM submissions JOIN quizzes ON submissions.quizz_id = quizzes.id ORDER BY `submission_id` DESC LIMIT 1;";

                $result = mysqli_query($conn, $sql);



                foreach ($result as $row) {

                    $data = [];
                    $data[] = $row;


                    echo json_encode($data[0]);
                    break;
                }
            } else {
                echo json_encode(array("error" => "Submission quiz failed."));
            }
        } else {
            $response = [
                "error" => "Error executing"
            ];
            echo json_encode($response);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        $data = json_decode(file_get_contents("php://input"));
        $submission_id = $data->params->submission_id;

        $sql = "UPDATE submissions SET start_time = NOW() WHERE id = $submission_id";

        if (mysqli_query($conn, $sql)) {
            echo json_encode(array("message" => "Update done"));
        } else {
            echo json_encode(array("error" => "Update fails"));
        }
    }

    $conn->close();
} catch (Exception $e) {
    echo json_encode(array("message" => "Error: " . $e->getMessage()));
}
