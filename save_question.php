<?php
require "conn.php";

// Get the posted data
$question_text = $conn->real_escape_string($_POST['question_text']);
$condition = $conn->real_escape_string($_POST['condition']);
$condition_wrong1 = $conn->real_escape_string($_POST['condition_wrong1']);
$condition_wrong2 = $conn->real_escape_string($_POST['condition_wrong2']);
$condition_wrong3 = $conn->real_escape_string($_POST['condition_wrong3']);

$action1 = $conn->real_escape_string($_POST['action1']);
$action2 = $conn->real_escape_string($_POST['action2']);
$action_wrong1 = $conn->real_escape_string($_POST['action_wrong1']);
$action_wrong2 = $conn->real_escape_string($_POST['action_wrong2']);
$action_wrong3 = $conn->real_escape_string($_POST['action_wrong3']);

$parameter1 = $conn->real_escape_string($_POST['parameter1']);
$parameter2 = $conn->real_escape_string($_POST['parameter2']);
$parameter_wrong1 = $conn->real_escape_string($_POST['parameter_wrong1']);
$parameter_wrong2 = $conn->real_escape_string($_POST['parameter_wrong2']);
$parameter_wrong3 = $conn->real_escape_string($_POST['parameter_wrong3']);

// Start a transaction
$conn->begin_transaction();

try {
    // Insert the question into the quizes table
    $sql = "INSERT INTO quizes (question_text, question_author) VALUES ('$question_text', 2)";
    if (!$conn->query($sql)) {
        throw new Exception($conn->error);
    }
    $question_id = $conn->insert_id;

    // Insert correct and incorrect conditions into conditions table
    $sql = "INSERT INTO conditions (condition_text) VALUES ('$condition')";
    if (!$conn->query($sql)) {
        throw new Exception($conn->error);
    }
    $condition_id = $conn->insert_id;

    $sql = "INSERT INTO question_conditions (qc_question, qc_condition, qc_is_correct) VALUES ($question_id, $condition_id, TRUE)";
    if (!$conn->query($sql)) {
        throw new Exception($conn->error);
    }

    $sql = "INSERT INTO conditions (condition_text) VALUES ('$condition_wrong1'), ('$condition_wrong2'), ('$condition_wrong3')";
    if (!$conn->query($sql)) {
        throw new Exception($conn->error);
    }
    
    $condition_wrong1_id = $conn->insert_id;

    // Link incorrect conditions to the question
    $sql = "INSERT INTO question_conditions (qc_question, qc_condition, qc_is_correct) 
            VALUES ($question_id, $condition_wrong1_id, FALSE), 
                   ($question_id, $condition_wrong1_id+1, FALSE), 
                   ($question_id, $condition_wrong1_id+2, FALSE)";
    if (!$conn->query($sql)) {
        throw new Exception($conn->error);
    }

    // Insert correct and incorrect actions into actions table
    $sql = "INSERT INTO actions (action_text) VALUES ('$action1'), ('$action2')";
    if (!$conn->query($sql)) {
        throw new Exception($conn->error);
    }

    $action1_id = $conn->insert_id;

    $sql = "INSERT INTO question_actions (qa_question, qa_action, qa_is_correct) VALUES 
            ($question_id, $action1_id, TRUE), 
            ($question_id, $action1_id+1, TRUE)";
    if (!$conn->query($sql)) {
        throw new Exception($conn->error);
    }

    $sql = "INSERT INTO actions (action_text) VALUES ('$action_wrong1'), ('$action_wrong2'), ('$action_wrong3')";
    if (!$conn->query($sql)) {
        throw new Exception($conn->error);
    }

    $action_wrong1_id = $conn->insert_id;

    // Link incorrect actions to the question
    $sql = "INSERT INTO question_actions (qa_question, qa_action, qa_is_correct) 
            VALUES ($question_id, $action_wrong1_id, FALSE), 
                   ($question_id, $action_wrong1_id+1, FALSE), 
                   ($question_id, $action_wrong1_id+2, FALSE)";
    if (!$conn->query($sql)) {
        throw new Exception($conn->error);
    }

    // Insert correct and incorrect parameters into parameters table
    $sql = "INSERT INTO parameters (parameter_text) VALUES ('$parameter1'), ('$parameter2')";
    if (!$conn->query($sql)) {
        throw new Exception($conn->error);
    }

    $parameter1_id = $conn->insert_id;

    $sql = "INSERT INTO question_parameters (qp_question, qp_parameter, qp_is_correct) VALUES 
            ($question_id, $parameter1_id, TRUE), 
            ($question_id, $parameter1_id+1, TRUE)";
    if (!$conn->query($sql)) {
        throw new Exception($conn->error);
    }

    $sql = "INSERT INTO parameters (parameter_text) VALUES ('$parameter_wrong1'), ('$parameter_wrong2'), ('$parameter_wrong3')";
    if (!$conn->query($sql)) {
        throw new Exception($conn->error);
    }

    $parameter_wrong1_id = $conn->insert_id;

    // Link incorrect parameters to the question
    $sql = "INSERT INTO question_parameters (qp_question, qp_parameter, qp_is_correct) 
            VALUES ($question_id, $parameter_wrong1_id, FALSE), 
                   ($question_id, $parameter_wrong1_id+1, FALSE), 
                   ($question_id, $parameter_wrong1_id+2, FALSE)";
    if (!$conn->query($sql)) {
        throw new Exception($conn->error);
    }

    // Commit the transaction
    $conn->commit();

    echo "Question saved successfully!";
} catch (Exception $e) {
    // Rollback the transaction if anything failed
    $conn->rollback();
    echo "Failed to save question: " . $e->getMessage();
}

$conn->close();
?>
