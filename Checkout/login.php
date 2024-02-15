<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="form">
		<h2>Login</h2>
		<form action="">
			<div class="error-text">
				Error
			</div>
			
			<div class="input">
				<label >Email</label>
				<input type="email" name="email" placeholder="Enter your Email" required >
			</div>
				<div class="input">
					<label >Password</label>
					<input type="password" name="pass" placeholder="Password" required >
				<div class="submit">
					<input type="submit" value="Login" class="button">
				</div>
			</div>
		</form>
		<div class="link">Not Signed up? <a href="register.php">Signup Now</a></div>
	</div>
	<script src="login.js"></script>
</body>
</html>