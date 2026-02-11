<?php
session_start();
include('theory_data.php'); 

$sub = strtolower($_GET['sub']);
$type = $_GET['type'];

// Fetch from your theory_data.php file
$questions = $all_theories[$sub] ?? ["No questions found."];
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo strtoupper($sub); ?> Exam</title>
    <style>
        body { background: #FFFDD0; padding: 30px; font-family: sans-serif; }
        .exam-sheet { background: white; padding: 40px; border: 2px solid #2e7d32; max-width: 800px; margin: auto; border-radius:15px; }
        .q-block { margin-bottom: 30px; border-bottom: 1px solid #eee; padding-bottom: 20px; }
        textarea { width: 100%; padding: 10px; margin-top: 5px; border-radius: 5px; border: 1px solid #ccc; }
        .btn { background:#2e7d32; color:white; padding:15px 40px; border:none; cursor:pointer; font-weight:bold; border-radius:5px; }
    </style>
</head>
<body>
    <div class="exam-sheet">
        <div style="text-align:center;"><img src="1000397721.jpg" width="60"></div>
        <h1><?php echo strtoupper($sub); ?> - <?php echo strtoupper($type); ?></h1>
        <hr>
        
        <form action="grade.php" method="POST">
            <input type="hidden" name="subject" value="<?php echo $sub; ?>">
            <input type="hidden" name="type" value="<?php echo $type; ?>">

            <?php foreach($questions as $index => $q): ?>
                <div class="q-block">
                    <p><strong>Question <?php echo $index + 1; ?>:</strong> <?php echo $q; ?></p>
                    <?php if($type == 'obj'): ?>
                        <input type="radio" name="q<?php echo $index; ?>" value="A"> A <br>
                        <input type="radio" name="q<?php echo $index; ?>" value="B"> B <br>
                        <input type="radio" name="q<?php echo $index; ?>" value="C"> C <br>
                        <input type="radio" name="q<?php echo $index; ?>" value="D"> D <br>
                    <?php else: ?>
                        <textarea rows="4" name="ans[]" placeholder="Type your theory answer here..."></textarea>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            
            <button type="submit" class="btn">FINISH AND SUBMIT</button>
        </form>
    </div>
</body>
</html>
