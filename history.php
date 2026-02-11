<?php
session_start();
$logs = $_SESSION['exam_logs'] ?? [];
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        body { background: #FFFDD0; font-family: sans-serif; padding: 40px; }
        table { width: 100%; background: white; border-collapse: collapse; border-radius: 10px; overflow: hidden; }
        th, td { padding: 15px; border: 1px solid #ddd; text-align: left; }
        th { background: #2e7d32; color: white; }
        .nav-back { margin-bottom: 20px; display: block; color: #2e7d32; font-weight: bold; }
    </style>
</head>
<body>
    <a href="dashboard.php" class="nav-back">⬅ Back to Dashboard</a>
    <h2>Exam Performance History for <?php echo $_SESSION['name']; ?></h2>
    
    <?php if(empty($logs)): ?>
        <p>No exams taken yet.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Date</th>
                <th>Subject</th>
                <th>Type</th>
                <th>Score</th>
            </tr>
            <?php foreach(array_reverse($logs) as $row): ?>
            <tr>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['subject']; ?></td>
                <td><?php echo $row['type']; ?></td>
                <td><strong><?php echo $row['score']; ?></strong></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>
