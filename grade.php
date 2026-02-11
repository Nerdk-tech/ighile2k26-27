<?php
session_start();
include('obj_data.php'); // This contains the correct answers

if ($_POST) {
    $subject = strtolower($_POST['subject']);
    $type = $_POST['type'];
    $score_display = "";

    if ($type == 'obj') {
        $actual_score = 0;
        // Get the correct answers for this specific subject
        $answer_key = $all_objectives[$subject];
        $total_questions = count($answer_key);

        // Loop through the student's submitted answers
        if (isset($_POST['ans'])) {
            foreach ($_POST['ans'] as $index => $student_answer) {
                // Compare student choice (A, B, C, D) with the 'correct' key in our data
                if ($student_answer === $answer_key[$index]['correct']) {
                    $actual_score++;
                }
            }
        }
        $score_display = $actual_score . " / " . $total_questions;
    } else {
        // Theory can't be auto-graded, so we just mark it as submitted
        $score_display = "Submitted (Pending)";
    }

    // CREATE THE HISTORY ENTRY
    $entry = [
        "date" => date("d M Y, h:i A"),
        "subject" => ucfirst($subject),
        "type" => ucfirst($type),
        "score" => $score_display
    ];

    // SAVE TO SESSION LOGS (This is what history.php reads)
    $_SESSION['exam_logs'][] = $entry;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Result - IGS Portal</title>
    <style>
        body { background: #FFFDD0; font-family: sans-serif; text-align: center; padding-top: 100px; }
        .result-box { background: white; display: inline-block; padding: 50px; border: 3px solid #2e7d32; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .score { font-size: 40px; color: #2e7d32; font-weight: bold; margin: 20px 0; }
        .btn { background: #2e7d32; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; display: inline-block; margin: 5px; }
        .btn-dark { background: #444; }
    </style>
</head>
<body>
    <div class="result-box">
        <img src="1000397721.jpg" width="100"><br>
        <h1 style="color: #2e7d32;">Exam Submitted!</h1>
        <p>Subject: <strong><?php echo ucfirst($subject); ?></strong></p>
        <div class="score"><?php echo $score_display; ?></div>
        <p>Your performance has been recorded in your history.</p>
        <br>
        <a href="history.php" class="btn">View My History</a>
        <a href="dashboard.php" class="btn btn-dark">Back to Dashboard</a>
    </div>
</body>
</html>
