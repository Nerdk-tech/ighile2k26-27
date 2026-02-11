<?php
session_start();
if($_POST) {
    $_SESSION['name'] = $_POST['student_name'];
    $_SESSION['course'] = $_POST['course'];
}
$course = $_SESSION['course'];
$core = ["English", "Maths", "Digital Tech", "Livestock Farming", "Civic"];
$depts = [
    "science" => ["Biology", "Chemistry", "Geography", "Physics"],
    "art" => ["CRS", "Literature", "Economics", "Government"],
    "commercial" => ["Marketing", "Economics", "Government", "Commerce"]
];
$my_subjects = array_merge($core, $depts[$course]);
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        body { background: #FFFDD0; margin: 0; font-family: sans-serif; }
        .nav { background: #2e7d32; color: white; padding: 15px; display: flex; align-items: center; }
        /* Hamburger Menu */
        .menu-btn { font-size: 30px; cursor: pointer; margin-right: 20px; }
        .sidebar { height: 100%; width: 0; position: fixed; z-index: 1; top: 0; left: 0; background-color: #111; overflow-x: hidden; transition: 0.5s; padding-top: 60px; }
        .sidebar a { padding: 8px 32px; text-decoration: none; font-size: 20px; color: #818181; display: block; }
        .sidebar a:hover { color: #f1f1f1; }
        
        .grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; padding: 40px; }
        .sub-card { background: white; border: 2px solid #2e7d32; padding: 30px; text-align: center; border-radius: 10px; cursor: pointer; }
    </style>
</head>
<body>

<div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" onclick="closeNav()">&times; Close</a>
  <a href="history.php">Exam History</a>
  <a href="upload.php">Upload Notes</a>
  <a href="literature_summary.php">Literature Summary</a>
  <a href="index.php">Logout</a>
</div>

<div class="nav">
    <span class="menu-btn" onclick="openNav()">&#9776;</span>
    <h2>SS2 <?php echo strtoupper($course); ?> DASHBOARD</h2>
</div>

<div class="grid">
    <?php foreach($my_subjects as $s): ?>
        <div class="sub-card" onclick="location.href='questions.php?sub=<?php echo $s; ?>'">
            <h3><?php echo $s; ?></h3>
            <small>Click to view Past Questions</small>
        </div>
    <?php endforeach; ?>
</div>

<script>
function openNav() { document.getElementById("mySidebar").style.width = "250px"; }
function closeNav() { document.getElementById("mySidebar").style.width = "0"; }
</script>
</body>
</html>
