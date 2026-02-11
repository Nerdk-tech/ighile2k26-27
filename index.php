<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>IGS Portal Login</title>
    <style>
        body {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('1000397710.png');
            background-size: cover; font-family: 'Segoe UI', sans-serif;
            display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;
        }
        .login-box {
            background: #FFFDD0; padding: 40px; border-radius: 15px; 
            text-align: center; width: 400px; border: 3px solid #2e7d32;
        }
        select, input { width: 100%; padding: 12px; margin: 10px 0; border-radius: 5px; border: 1px solid #ccc; }
        button { background: #2e7d32; color: white; border: none; padding: 15px; width: 100%; cursor: pointer; font-weight: bold; }
    </style>
</head>
<body>
    <div class="login-box">
        <img src="1000397721.jpg" width="100">
        <h2 style="color: #2e7d32;">IGHILE GROUP OF SCHOOLS</h2>
        <form action="dashboard.php" method="POST">
            <input type="text" name="student_name" placeholder="Enter Full Name" required>
            <select name="course" required>
                <option value="">-- Select Your Course --</option>
                <option value="science">SCIENCE</option>
                <option value="art">ART</option>
                <option value="commercial">COMMERCIAL (BUSINESS)</option>
            </select>
            <button type="submit">ENTER PORTAL</button>
        </form>
    </div>
</body>
</html>
