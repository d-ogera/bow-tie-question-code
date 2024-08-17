<?php
require "conn.php";
session_start();

$user_id = 1;

// Fetch the user's answers along with the question details and the text of selected actions, conditions, and parameters
$query = "
    SELECT 
    us.quiz_id, 
    us.condition_correct, 
    us.action1_correct, 
    us.action2_correct, 
    us.parameter1_correct, 
    us.parameter2_correct, 
    q.question_text,
    GROUP_CONCAT(DISTINCT qc.condition_text) AS correct_condition,
    GROUP_CONCAT(DISTINCT ac1.action_text) AS correct_action1,
    GROUP_CONCAT(DISTINCT ac2.action_text) AS correct_action2,
    GROUP_CONCAT(DISTINCT pc1.parameter_text) AS correct_parameter1,
    GROUP_CONCAT(DISTINCT pc2.parameter_text) AS correct_parameter2,
    uc.condition_text AS user_condition,
    ua1.action_text AS user_action1,
    ua2.action_text AS user_action2,
    up1.parameter_text AS user_parameter1,
    up2.parameter_text AS user_parameter2
FROM user_scores us
INNER JOIN quizes q ON us.quiz_id = q.question_id
LEFT JOIN conditions qc ON qc.condition_id IN (
    SELECT qc_condition FROM question_conditions WHERE qc_question = us.quiz_id AND qc_is_correct = TRUE
)
LEFT JOIN actions ac1 ON ac1.action_id IN (
    SELECT qa_action FROM question_actions WHERE qa_question = us.quiz_id AND qa_is_correct = TRUE
)
LEFT JOIN actions ac2 ON ac2.action_id IN (
    SELECT qa_action FROM question_actions WHERE qa_question = us.quiz_id AND qa_is_correct = TRUE
)
LEFT JOIN parameters pc1 ON pc1.parameter_id IN (
    SELECT qp_parameter FROM question_parameters WHERE qp_question = us.quiz_id AND qp_is_correct = TRUE
)
LEFT JOIN parameters pc2 ON pc2.parameter_id IN (
    SELECT qp_parameter FROM question_parameters WHERE qp_question = us.quiz_id AND qp_is_correct = TRUE
)
LEFT JOIN conditions uc ON uc.condition_id = us.condition_correct
LEFT JOIN actions ua1 ON ua1.action_id = us.action1_correct
LEFT JOIN actions ua2 ON ua2.action_id = us.action2_correct
LEFT JOIN parameters up1 ON up1.parameter_id = us.parameter1_correct
LEFT JOIN parameters up2 ON up2.parameter_id = us.parameter2_correct
WHERE us.u_id = $user_id
GROUP BY us.quiz_id;

";

$result = $conn->query($query);

if (!$result) {
    die("Error fetching user answers: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    <link href="styles.css" rel="stylesheet">
</head>
<body>

<h2>Your Results</h2>
<table>
    <thead>
        <tr>
            <th>Question</th>
            <th>Your Condition</th>
            <th>Correct Condition</th>
            <th>Action 1</th>
            <th>Correct Action 1</th>
            <th>Action 2</th>
            <th>Correct Action 2</th>
            <th>Parameter 1</th>
            <th>Correct Parameter 1</th>
            <th>Parameter 2</th>
            <th>Correct Parameter 2</th>
            <th>Score</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>

        <tr>
            <td><?php echo htmlspecialchars($row['question_text']); ?></td>

            <td class="<?php echo $row['condition_correct'] ? 'correct' : 'incorrect'; ?>">
                <?php echo htmlspecialchars($row['user_condition']); ?>
            </td>

            <td><?php echo htmlspecialchars($row['correct_condition']); ?></td>

            <td class="<?php echo $row['action1_correct'] ? 'correct' : 'incorrect'; ?>">
                <?php echo htmlspecialchars($row['user_action1']); ?>
            </td>

            <td><?php echo htmlspecialchars($row['correct_action1']); ?></td>

            <td class="<?php echo $row['action2_correct'] ? 'correct' : 'incorrect'; ?>">
                <?php echo htmlspecialchars($row['user_action2']); ?>
            </td>

            <td><?php echo htmlspecialchars($row['correct_action2']); ?></td>

            <td class="<?php echo $row['parameter1_correct'] ? 'correct' : 'incorrect'; ?>">
                <?php echo htmlspecialchars($row['user_parameter1']); ?>
            </td>

            <td><?php echo htmlspecialchars($row['correct_parameter1']); ?></td>

            <td class="<?php echo $row['parameter2_correct'] ? 'correct' : 'incorrect'; ?>">
                <?php echo htmlspecialchars($row['user_parameter2']); ?>
            </td>
            <td><?php echo htmlspecialchars($row['correct_parameter2']); ?></td>

            <td><?php 
                $score = $row['condition_correct'] + $row['action1_correct'] + $row['action2_correct'] + $row['parameter1_correct'] + $row['parameter2_correct']; 
                echo $score . " / 5";
            ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>

<?php
$conn->close();
?>
