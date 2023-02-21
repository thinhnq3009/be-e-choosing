<?php
include '../connect.php';

if (true) {

    $sql = 'SELECT * FROM `quizzes`';

    if (isset($_GET['name'])) {
        $sql = 'SELECT * FROM `quizzes` WHERE name LIKE "%' . $_GET['name'] . '%"';
    } else if (isset($_GET['code'])) {
        $sql = 'SELECT * FROM `quizzes` WHERE join_code LIKE "' . $_GET['code'] . '"';
    } else if (isset($_GET['all'])) {
        $sql = "SELECT quizzes.*, COUNT(questions.id) AS 'num_of_question' FROM quizzes INNER JOIN questions ON questions.quizz_id = quizzes.id GROUP BY quizzes.id;";
    }


    $result = mysqli_query($conn, $sql);

    $response = [];

    if (isset($result)) {


        $data = [];
        foreach ($result as $row) {
            $data[] = $row;
        }
        echo phpversion(); // Output: 8.0.11
        
        if (count($data) > 0) {
            if (isset($_GET['all'])) {
                echo json_encode($data);
            } else {
                echo json_encode($data[0]);
            }
        } else {
            echo json_encode(array("error" => "No Quiz found."));
        }
    } else {
        $response = [
            "error" => "Error executing"
        ];
        echo json_encode($response);
    }
}
