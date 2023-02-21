<?php


include "../connect.php";

function getQuestion($conn)
{
    try {

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {


            if (isset($_GET['id']) && !$_GET['id']) {
                echo json_encode(array(
                    "error" => "Invalid id",
                ));
                return;
            }
            $id = $_GET['id'];

            $sql = "SELECT * FROM questions WHERE questions.quizz_id = $id;";


            $result = $conn->query($sql);
            $output = array();
            $output = $result->fetch_all(MYSQLI_ASSOC);

            $new_output = array();
            foreach ($output as $item ) {
                $id = $item["id"];

                $sql = "SELECT * FROM answers WHERE answers.quesion_id = $id;";

                $response = $conn->query($sql);
                $answers = array();
                $answers = $response->fetch_all(MYSQLI_ASSOC);
                $item["answers"] = $answers;
                array_push($new_output, $item);
            }
            echo json_encode($new_output);
        }
    } catch (Exception $e) {
        echo json_encode(array("message" => "Error: " . $e->getMessage()));
    }
    $conn->close();
}
getQuestion($conn);
