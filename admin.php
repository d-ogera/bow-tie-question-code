<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Bow-Tie Question with Options</title>
    <link href="styles.css" rel="stylesheet">

</head>
<body>
    <div class="container">
        <form action="save_question.php" method="post">
            <!-- Question Text -->
            <div class="form-group">
                <label for="question_text">Question Text:</label>
                <textarea name="question_text" id="question_text" rows="4" required></textarea>
            </div>

            <!-- Conditions -->
            <div class="form-group">
                <label for="condition">Correct Condition:</label>
                <input type="text" name="condition" id="condition" required>
            </div>
            <div class="form-group">
                <label for="condition_wrong1">Incorrect Condition 1:</label>
                <input type="text" name="condition_wrong1" id="condition_wrong1" required>
            </div>
            <div class="form-group">
                <label for="condition_wrong2">Incorrect Condition 2:</label>
                <input type="text" name="condition_wrong2" id="condition_wrong2" required>
            </div>
            <div class="form-group">
                <label for="condition_wrong3">Incorrect Condition 3:</label>
                <input type="text" name="condition_wrong3" id="condition_wrong3" required>
            </div>

            <!-- Actions -->
            <div class="form-group">
                <label for="action1">Correct Action 1:</label>
                <input type="text" name="action1" id="action1" required>
            </div>
            <div class="form-group">
                <label for="action2">Correct Action 2:</label>
                <input type="text" name="action2" id="action2" required>
            </div>
            <div class="form-group">
                <label for="action_wrong1">Incorrect Action 1:</label>
                <input type="text" name="action_wrong1" id="action_wrong1" required>
            </div>
            <div class="form-group">
                <label for="action_wrong2">Incorrect Action 2:</label>
                <input type="text" name="action_wrong2" id="action_wrong2" required>
            </div>
            <div class="form-group">
                <label for="action_wrong3">Incorrect Action 3:</label>
                <input type="text" name="action_wrong3" id="action_wrong3" required>
            </div>

            <!-- Parameters -->
            <div class="form-group">
                <label for="parameter1">Correct Parameter 1:</label>
                <input type="text" name="parameter1" id="parameter1" required>
            </div>
            <div class="form-group">
                <label for="parameter2">Correct Parameter 2:</label>
                <input type="text" name="parameter2" id="parameter2" required>
            </div>
            <div class="form-group">
                <label for="parameter_wrong1">Incorrect Parameter 1:</label>
                <input type="text" name="parameter_wrong1" id="parameter_wrong1" required>
            </div>
            <div class="form-group">
                <label for="parameter_wrong2">Incorrect Parameter 2:</label>
                <input type="text" name="parameter_wrong2" id="parameter_wrong2" required>
            </div>
            <div class="form-group">
                <label for="parameter_wrong3">Incorrect Parameter 3:</label>
                <input type="text" name="parameter_wrong3" id="parameter_wrong3" required>
            </div>

            <!-- Submit button -->
            <input type="submit" value="Save Question">
        </form>
    </div>
</body>
</html>
