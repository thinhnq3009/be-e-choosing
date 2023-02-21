<?php


include "../connect.php";


try {

    // Phương thức POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = json_decode(file_get_contents("php://input"));

        // print_r($data);

        $submission = $data->params->submission_id;
        $question = $data->params->question_id;
        $answer = $data->params->answer_id;




        $sql = "INSERT INTO `quizz_answers`( `submission_id`, `question_id`, `answer_id`) VALUES ($submission , $question, $answer)";

        // echo $sql;

        if (mysqli_query($conn, $sql)) {
            echo json_encode(array("success" => "Save answer success."));
        } else {
            echo json_encode(array("error" => "Save answer failed."));
        }
        // $result = mysqli_query($conn, $sql);

        // $response = [];

        // if (isset($result)) {
        //     $data = [];
        //     foreach ($result as $row) {
        //         $data[] = $row;
        //     }

        //     $data = $data[0];
        //     $quizId = $data['id'];
        //     // $sql =  "SELECT * FROM submissions WHERE submissions.end_time IS NULL AND user_id = $id AND quizz_id = $quizId;";
        //     $sql = "INSERT INTO `submissions`( `user_id`, `quizz_id`) VALUES ($id ,$quizId); ";


        //     if (mysqli_query($conn, $sql)) {

        //     } else {
        //         echo json_encode(array("error" => "Submission quiz failed."));
        //     }
        // } else {
        //     $response = [
        //         "error" => "Error executing"
        //     ];
        //     echo json_encode($response);
        // }
    }


    $conn->close();
} catch (Exception $e) {
    echo json_encode(array("message" => "Error: " . $e->getMessage()));
}
