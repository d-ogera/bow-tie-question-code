<?php
require "conn.php";

// Get the posted data and ensure they are integers
$selected_action1 = intval($_POST['selected_action1']);
$selected_action2 = intval($_POST['selected_action2']);
$selected_condition = intval($_POST['selected_condition']);
$selected_parameter1 = intval($_POST['selected_parameter1']);
$selected_parameter2 = intval($_POST['selected_parameter2']);

// Fetch correct answers from the database
$question_id = 4; // Example question ID
$user_id = 1; // Example user ID

$query = "
    SELECT 
        IFNULL((SELECT COUNT(*) FROM question_conditions WHERE qc_question = $question_id AND qc_condition = 
            $selected_condition AND qc_is_correct = TRUE), 0) AS is_correct_condition,
        IFNULL((SELECT COUNT(*) FROM question_actions WHERE qa_question = $question_id AND qa_action = 
            $selected_action1 AND qa_is_correct = TRUE), 0) AS is_correct_action1,
        IFNULL((SELECT COUNT(*) FROM question_actions WHERE qa_question = $question_id AND qa_action = 
            $selected_action2 AND qa_is_correct = TRUE), 0) AS is_correct_action2,
        IFNULL((SELECT COUNT(*) FROM question_parameters WHERE qp_question = $question_id AND qp_parameter = 
            $selected_parameter1 AND qp_is_correct = TRUE), 0) AS is_correct_parameter1,
        IFNULL((SELECT COUNT(*) FROM question_parameters WHERE qp_question = $question_id AND qp_parameter = 
            $selected_parameter2 AND qp_is_correct = TRUE), 0) AS is_correct_parameter2
";

$result = $conn->query($query);

if (!$result) {
    die("Error executing query: " . $conn->error);
}

$row = $result->fetch_assoc();

$is_correct_condition = $row['is_correct_condition'] > 0 ? 1 : 0;
$is_correct_action1 = $row['is_correct_action1'] > 0 ? 1 : 0;
$is_correct_action2 = $row['is_correct_action2'] > 0 ? 1 : 0;
$is_correct_parameter1 = $row['is_correct_parameter1'] > 0 ? 1 : 0;
$is_correct_parameter2 = $row['is_correct_parameter2'] > 0 ? 1 : 0;

// Calculate total score
$total_score = $is_correct_condition + $is_correct_action1 + $is_correct_action2 + $is_correct_parameter1 + $is_correct_parameter2;

// Debug output
echo "total:$total_score, question: $question_id, user: $user_id, Condition: $is_correct_condition, Action1: $is_correct_action1, Action2: $is_correct_action2, Parameter1: $is_correct_parameter1, Parameter2: $is_correct_parameter2";

// Insert the scoring information into the user_scores table
$insert_query = "
    INSERT INTO `user_scores`(`score_id`, `u_id`, `quiz_id`, `condition_correct`, `action1_correct`, `action2_correct`, `parameter1_correct`, `parameter2_correct`, `total_score`)
    VALUES (NULL, $user_id, $question_id, $is_correct_condition, $is_correct_action1, $is_correct_action2, $is_correct_parameter1, $is_correct_parameter2, $total_score)
";

if ($conn->query($insert_query) === TRUE) {
    echo "Score recorded successfully!";
} else {
    echo "Error recording score: " . $conn->error;
}

// Close connection
$conn->close();
?>