<?php
require "conn.php";

// Example question ID (this could be passed dynamically through a GET parameter)
$question_id = 4;

// Fetch question details
$question_query = "SELECT * FROM quizes WHERE question_id = $question_id";
$question_result = $conn->query($question_query);
$question = $question_result->fetch_assoc();
$allsubcats = mysqli_num_rows($question_result);

// Fetch actions (both correct and incorrect)
$actions_query = "
    SELECT action_id, action_text, qa_is_correct
    FROM actions 
    INNER JOIN question_actions ON action_id = qa_action
    WHERE qa_question = $question_id";
$actions_result = $conn->query($actions_query);



// Fetch conditions (both correct and incorrect)
$conditions_query = "
    SELECT condition_id, condition_text, qc_is_correct
    FROM conditions
    INNER JOIN question_conditions ON condition_id = qc_condition
    WHERE qc_question = $question_id";
$conditions_result = $conn->query($conditions_query);

// Fetch parameters (both correct and incorrect)
$parameters_query = "
    SELECT parameter_id, parameter_text, qp_is_correct
    FROM parameters
    INNER JOIN question_parameters ON parameter_id = qp_parameter
    WHERE qp_question = $question_id";
$parameters_result = $conn->query($parameters_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bow-Tie Question </title>
    <link href="styles.css" rel="stylesheet">

</head>
<body>

<h2>Bow-Tie Question <?php echo $allsubcats;?></h2>
<p>The nurse is reviewing the client’s assessment data to prepare the client’s plan of care.</p>

<form action="submit_answer.php" method="post">
    <div class="container">
        <!-- Actions to Take -->
        <div class="box">
            <h3>Actions to Take</h3>
            <div id="action1" class="droppable" ondrop="drop(event)" ondragover="allowDrop(event)">
                <input type="hidden" name="selected_action1" id="selected_action1">
            </div>
            <div id="action2" class="droppable" ondrop="drop(event)" ondragover="allowDrop(event)">
                <input type="hidden" name="selected_action2" id="selected_action2">
            </div>
        </div>

        <!-- Condition Most Likely Experiencing -->
        <div class="box">
            <h3>Condition Most Likely Experiencing</h3>
            <div id="condition" class="droppable" ondrop="drop(event)" ondragover="allowDrop(event)">
                <input type="hidden" name="selected_condition" id="selected_condition">
            </div>
        </div>

        <!-- Parameters to Monitor -->
        <div class="box">
            <h3>Parameters to Monitor</h3>
            <div id="parameter1" class="droppable" ondrop="drop(event)" ondragover="allowDrop(event)">
                <input type="hidden" name="selected_parameter1" id="selected_parameter1">
            </div>
            <div id="parameter2" class="droppable" ondrop="drop(event)" ondragover="allowDrop(event)">
                <input type="hidden" name="selected_parameter2" id="selected_parameter2">
            </div>
        </div>
    </div>

    <h3>Options</h3>
    <div class="container">

                <!-- Available Actions -->
        <div class="box">
            <h4>Actions</h4>
            <?php while($action = $actions_result->fetch_assoc()): ?>
                <div id="a<?= $action['action_id'] ?>" 
                     class="draggable" 
                     draggable="true" 
                     ondragstart="drag(event)" 
                     data-value="<?= $action['action_id'] ?>">
                    <?= htmlspecialchars($action['action_text']) ?>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Available Conditions -->
        <div class="box">
            <h4>Conditions</h4>
            <?php while($condition = $conditions_result->fetch_assoc()): ?>
                <div id="b<?= $condition['condition_id'] ?>" 
                     class="draggable" 
                     draggable="true" 
                     ondragstart="drag(event)" 
                     data-value="<?= $condition['condition_id'] ?>">
                    <?= htmlspecialchars($condition['condition_text']) ?>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Available Parameters -->
        <div class="box">
            <h4>Parameters</h4>
            <?php while($parameter = $parameters_result->fetch_assoc()): ?>
                <div id="c<?= $parameter['parameter_id'] ?>" 
                     class="draggable" 
                     draggable="true" 
                     ondragstart="drag(event)" 
                     data-value="<?= $parameter['parameter_id'] ?>">
                    <?= htmlspecialchars($parameter['parameter_text']) ?>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <button type="submit">Submit Answer</button>
</form>

<script>
    function allowDrop(event) {
        event.preventDefault();
    }

    function drag(event) {
        event.dataTransfer.setData("text", event.target.id);
    }

    function drop(event) {
        event.preventDefault();
        var data = event.dataTransfer.getData("text");
        var element = document.getElementById(data);
        var target = event.target;

        // Avoid appending element to other elements
        if (target.classList.contains('droppable')) {
            target.appendChild(element);

            // Set the hidden input value to the dragged option's data-value
            var hiddenInput = target.querySelector('input[type="hidden"]');
            if (hiddenInput) {
                hiddenInput.value = element.getAttribute("data-value");
            }
        }
    }
</script>

</body>
</html>

<?php
$conn->close();
?>
