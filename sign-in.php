<?php require_once 'database/connection.php'; ?>

<?php
session_start();
$title = 'Sign In';
$error = $email = "";

if(isset($_POST['signin'])) {
	$email = htmlspecialchars($_POST['email']);
	$password = htmlspecialchars($_POST['password']);

	if(empty($email)) {
		$error = "Please enter your E-mail!";
	} elseif(empty($password)) {
		$error = "Please enter your Password!";
	} else {
		$new_password = sha1($password);
		$sql = "SELECT `id` FROM `admins` WHERE `email` = '$email' AND `password` = '$new_password'";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$admin = $result->fetch_assoc();
			$_SESSION['admin_id'] = $admin['id'];
			header('location: ./template.php');
		} else {
			$error = "Invalid Combination!";
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<?php require_once 'includes/head.php'; ?>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Welcome back, Magician</h1>
							<p class="lead">
								Sign in to your account to continue
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<div class="text-danger"><?php echo $error; ?></div>
									<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email" value="<?php echo $email; ?>">
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password">
										</div>
										<div class="text-center mt-3">
											<button type="submit" class="btn btn-lg btn-primary" name="signin">Sign in</button>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>

</body>

</html>