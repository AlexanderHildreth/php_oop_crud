<div class="col-lg-offset-3 col-md-offset-3 col-lg-6 col-md-6">
	<form action="register.php" method="POST" class="jumbotron">
		<div class="form-group">
			<label for="first_name">First Name</label>
			<input type="text" class="form-control" id="firstName" placeholder="First Name" name="first_name">
		</div>
		<div class="form-group">
			<label for="last_name">Last Name</label>
			<input type="text" class="form-control" id="last_name" placeholder="Last Name" name="last_name">
		</div>
		<div class="form-group">
			<label for="email">Email address</label>
			<input type="email" class="form-control" id="email" placeholder="Email Address" name="email">
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" class="form-control" id="password" placeholder="Password" name="password">
		</div>
		<div class="form-group">
			<label for="password">Confirm Password</label>
			<input type="password" class="form-control" id="password" placeholder="Confirm Password" name="confirm_password">
		</div>
		<button type="submit" class="btn btn-success">Register</button>
		<span>Or </span><a href="login.php">Login</a>
	</form>
</div>