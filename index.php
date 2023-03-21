<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #F5F5F5;
		}
		form {
			background-color: white;
			border-radius: 10px;
			padding: 20px;
			width: 400px;
			margin: 50px auto;
			box-shadow: 0 0 10px rgba(0,0,0,0.2);
		}
		h2 {
			text-align: center;
			color: #333;
			margin-top: 0;
		}
		label {
			display: block;
			font-size: 14px;
			color: #333;
			margin-bottom: 5px;
		}
		input[type="text"],
		input[type="password"] {
			width: 100%;
			padding: 10px;
			font-size: 14px;
			border: 1px solid #ccc;
			border-radius: 4px;
			margin-bottom: 10px;
			box-sizing: border-box;
		}
		button[type="submit"] {
			background-color: #4CAF50;
			color: white;
			padding: 10px 20px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			font-size: 16px;
			margin-top: 10px;
			width: 100%;
			box-sizing: border-box;
		}
		button[type="submit"]:hover {
			background-color: #45a049;
		}
		.error {
			color: red;
			font-size: 14px;
			margin-bottom: 10px;
			text-align: center;
		}
	</style>
</head>
<body>
     <form action="login.php" method="post">
     	<h2>LOGIN</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
     	<label for="uname">User Name</label>
     	<input type="text" id="uname" name="uname" placeholder="User Name">

     	<label for="password">Password</label>
     	<input type="password" id="password" name="password" placeholder="Password">

     	<button type="submit">Login</button>
     </form>
</body>
</html>
