<?php
session_start();
if(!isset($_SESSION['name'])) { header("Location: index.php"); }

$statusMsg = '';
$course = $_SESSION['course'];

// File upload logic
if(isset($_POST["submit_upload"])){
    $targetDir = "notes/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    if(!empty($_FILES["file"]["name"])){
        // Allow certain file formats
        $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg');
        if(in_array($fileType, $allowTypes)){
            // Upload file to server
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
            }else{
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }else{
            $statusMsg = 'Sorry, only PDF, DOC, DOCX, JPG, PNG & JPEG files are allowed.';
        }
    }else{
        $statusMsg = 'Please select a file to upload.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Notes - IGS</title>
    <style>
        body { background: #FFFDD0; margin: 0; font-family: sans-serif; }
        .nav { background: #2e7d32; color: white; padding: 15px; display: flex; align-items: center; }
        .menu-btn { font-size: 30px; cursor: pointer; margin-right: 20px; }
        .sidebar { height: 100%; width: 0; position: fixed; z-index: 1; top: 0; left: 0; background-color: #111; overflow-x: hidden; transition: 0.5s; padding-top: 60px; }
        .sidebar a { padding: 8px 32px; text-decoration: none; font-size: 20px; color: #818181; display: block; }
        .sidebar a:hover { color: #f1f1f1; }
        
        .upload-container { max-width: 600px; margin: 50px auto; background: white; padding: 30px; border-radius: 10px; border: 2px solid #2e7d32; text-align: center; }
        .status { margin-bottom: 20px; font-weight: bold; color: #2e7d32; }
        input[type="file"] { margin: 20px 0; border: 1px dashed #2e7d32; padding: 20px; width: 80%; }
        .btn { background: #2e7d32; color: white; border: none; padding: 15px 30px; cursor: pointer; border-radius: 5px; }
    </style>
</head>
<body>

<div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" onclick="closeNav()">&times; Close</a>
  <a href="dashboard.php">Dashboard</a>
  <a href="upload.php">Upload Notes</a>
  <a href="index.php">Logout</a>
</div>

<div class="nav">
    <span class="menu-btn" onclick="openNav()">&#9776;</span>
    <img src="1000397721.jpg" width="40" style="margin-right:15px;">
    <h2>UPLOAD STUDY NOTES</h2>
</div>

<div class="upload-container">
    <h3>Hello, <?php echo $_SESSION['name']; ?></h3>
    <p>Share your <strong><?php echo strtoupper($course); ?></strong> class notes with your mates.</p>
    
    <?php if(!empty($statusMsg)){ ?>
        <p class="status"><?php echo $statusMsg; ?></p>
    <?php } ?>

    <form action="" method="post" enctype="multipart/form-data">
        <label>Select File to Upload:</label><br>
        <input type="file" name="file" required>
        <br>
        <button type="submit" name="submit_upload" class="btn">START UPLOAD</button>
    </form>
    
    <hr style="margin-top:40px;">
    <h4>Recently Uploaded Files</h4>
    <div style="text-align: left; background: #f9f9f9; padding: 10px;">
        <?php
        $files = scandir("notes/");
        foreach($files as $file) {
            if($file !== "." && $file !== "..") {
                echo "<li><a href='notes/$file' target='_blank'>$file</a></li>";
            }
        }
        ?>
    </div>
</div>

<script>
function openNav() { document.getElementById("mySidebar").style.width = "250px"; }
function closeNav() { document.getElementById("mySidebar").style.width = "0"; }
</script>

</body>
</html>
