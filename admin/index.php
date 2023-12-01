<?php 
	session_start();
	$pageTitle = 'PlanFood Login';

	if(isset($_SESSION['username_restaurant_qRewacvAqzA']) && isset($_SESSION['password_restaurant_qRewacvAqzA']))
	{
		header('Location: makanan.php');
	}
?>

<?php include 'connect.php'; ?>
<?php include 'includes/functions/function.php'; ?>
<?php include 'includes/templates/header.php'; ?>


<!-- Login Form -->
<!--
<div class="py-5 d-flex align-items-center" style="min-height: calc(100vh - 100px);" data-bg-img="image/bg.png">
<div class="container">
<div class="row justify-content-center">
<div class="col-xl-5 col-lg-7 col-md-10">

<div class="card login-register-card">
	<div class="card-body">
		<div class="text-center mb-5">
			<h2>SignIn</h2>
			<p>Don't have an account yet? <a href="Register.html" class="c1">SignUp Now!</a></p>
		</div>
		<form class="validate-form" name="login-form" action="index.php" method="POST" onsubmit="return validateLoginForm()">
	</div>
</div>
</div>
</div>
</div>
</div>
-->

<div class="login" style="min-height: calc(100vh - 100px);">
			<form class="login-container validate-form" name="login-form" action="index.php" method="POST" onsubmit="return validateLoginForm()">
					<span class="login100-form-title p-b-32">
							PlanFood Login
						</span>
						
						<?php

							//Check if user click on the submit button

								if(isset($_POST['admin_login']))
								{
										$username = test_input($_POST['username']);
										$password = test_input($_POST['password']);

										//Check if User Exist In database

										$stmt = $con->prepare("Select user_id, username, password from users where username = ? and password = ?");
										$stmt->execute(array($username,$password));
										$row = $stmt->fetch();
										$count = $stmt->rowCount();

										// Check if count > 0 which mean that the database contain a record about this username

										if($count > 0)
										{

											$_SESSION['username_restaurant_qRewacvAqzA'] = $username;
												$_SESSION['password_restaurant_qRewacvAqzA'] = $password;
												$_SESSION['userid_restaurant_qRewacvAqzA'] = $row['user_id'];
												header('Location: dashboard.php');
												die();
										}
										else
										{
											?>
										<div class="alert alert-danger">
							<button data-dismiss="alert" class="close close-sm" type="button">
											<span aria-hidden="true">×</span>
									</button>
							<div class="messages">
								<div>Username and/or password are incorrect!</div>
							</div>
						</div>
										<?php 
									}
					}
				?>

				<!-- USERNAME INPUT -->

					<div class="form-input">
							<span class="txt1">Username</span>
								<input type="text" name="username" class = "form-control username" oninput="document.getElementById('username_required').style.display = 'none'" id="user" autocomplete="off">
							<div class="invalid-feedback" id="username_required">Username is required!</div>
					</div>

					<!-- PASSWORD INPUT -->
			
					<div class="form-input">
							<span class="txt1">Password</span>
							<input type="password" name="password" class="form-control" oninput="document.getElementById('password_required').style.display = 'none'" id="password" autocomplete="new-password">
							<div class="invalid-feedback" id="password_required">Password is required!</div>
					</div>

					<!-- SIGNIN BUTTON -->
			
					<p>
							<button type="submit" name="admin_login" >Sign In</button>
					</p>

					<!-- FORGOT PASSWORD PART -->

					<span class="forgotPW">Forgot your password ? <a href="resetPassword.php">Reset it here.</a></span>

				</form>
		</div>

<?php include 'includes/templates/footer.php'; ?>