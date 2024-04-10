<?php
session_save_path('./');
session_start();

// SQLite 데이터베이스 연결
$db = new SQLite3('cat_homepage.db');


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the entered username and password
    $enteredUsername = $_POST["username"];
    $enteredPassword = $_POST["password"];

    // Query to check user credentials
    $query = "SELECT * FROM users WHERE username='{$enteredUsername}' AND password='{$enteredPassword}' ";
    $result = $db->query($query);
    $row = $result->fetchArray();

    // Check if the entered credentials are valid
    if ($row) {
        // Redirect to the login success page
        $login_user = $row["username"];
        $_SESSION["user"] = $login_user;
        header("Location: page-{$login_user}.php");
        exit();
    } else {
        // Invalid credentials, you might want to display an error message
        $errorMessage = "Invalid username or password";
    }
}
?>
<html>
	<head>
		<style>
		        body {
		            font-family: Arial, sans-serif;
		            margin: 0;
		            padding: 0;
		            box-sizing: border-box;
		            background-color: #f4f4f4;
		        }
		
		        header {
		            background-color: #DE628B;
		            color: #fff;
		            text-align: center;
		            padding: 10px;
		        }
		
		        main {
		            padding: 20px;
		            margin-bottom: 80px;
		        }
		
		        form {
		            max-width: 400px;
		            margin: 0 auto;
		            background-color: #fff;
		            padding: 20px;
		            border-radius: 8px;
		            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
		        }
		
		        label {
		            display: block;
		            margin-bottom: 8px;
		            font-weight: bold;
		        }
		
		        input {
		            width: 100%;
		            padding: 12px;
		            margin-bottom: 20px;
		            border: 1px solid #ccc;
		            border-radius: 4px;
		            box-sizing: border-box;
		        }
		
		        input[type="submit"] {
		            background-color: #DE628B;
		            color: #fff;
		            cursor: pointer;
		            padding: 12px;
		            border: none;
		            border-radius: 4px;
		            box-sizing: border-box;
		        }
		
		        input[type="submit"]:hover {
		            background-color: #555;
		        }
		
		        footer, nav {
		            background-color: #DE628B;
		            color: #fff;
		            text-align: center;
		            padding: 10px;
		            position: fixed;
		            bottom: 0;
		            width: 100%;
		        }
		
		        nav a {
		            color: #fff;
		            text-decoration: none;
		            margin: 0 10px;
		        }
		    </style>
	</head>
	<body>

		<header>
        <h1>GRAPE 고양이 웹</h1>
    </header>

		<form method = "post">
			<h2>Login</h2>

			<?php
				if (isset($errorMessage)) {
					echo '<p style="color: red;">' . $errorMessage . '</p>';
				}
			?>

			
			<label for="username">username</label>
			<input name="username" type="text">

			<label for="password">password</label>
			<input name="password" type="password">

			<input type="submit" value="로그인">
		</form>

		<footer>
        <p>&copy; This is Cat Webpage. All rights reserved.</p>
    </footer>

	</body>
</html>