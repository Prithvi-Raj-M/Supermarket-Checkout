<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registration</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudfare.com/ajax/libs/font-awesomw/6.0.0/css/all.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
	<div class="form">
		<h2>Sign Up</h2>
		<form action="" enctype="multipart/form-data">
			<div class="error-text">Error</div>
			<div class="grid-details">
				<div class="input">
					<label >First Name</label>
					<input type="text" name="fname" placeholder="First Name" required pattern="[a-zA-Z'-'\s]*">
				<div class="input">
					<label >Last Name</label>
					<input type="text" name="lname" placeholder="Last Name" required pattern="[a-zA-Z'-'\s]*">
				</div>
			</div>
			<div class="input">
				<label >Email</label>
				<input type="email" name="email" placeholder="Enter your Email" required >
			</div>
			<div class="input">
				<label >Phone</label>
				<input type="tel" name="phone" placeholder="Phone Number" required pattern="[0-9]{10}" oninvalid="this.setCustomValidity('Enter 10 digit number' )"  oninput="this.setCustomValidity('')">
			</div>
			<div class="grid-details">
				<div class="input">
					<label >Password</label>
					<input type="password" name="pass" placeholder="Password" required >
				<div class="input">
					<label >Confirm Password</label>
					<input type="password" name="cpass" placeholder="Confirm Password" required >
				</div>
				<div class="submit">
					<input type="submit" value="Register" class="button">
				</div>
			</div>
		</form>
		<div class="link">Already Signed up?<a href="login.php">Login Now</a></div>
	</div>
	<script src="register.js"></script>
</body>
</html>