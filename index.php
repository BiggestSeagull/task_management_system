<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {

	?>
	<!DOCTYPE html>
	<html>

	<head>
		<meta charset=utf-8>

		<title>Панель управления</title>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">

	</head>

	<body>
		<input type="checkbox" id="checkbox">

		<?php include "inc/header.php" ?>

		<div class="body">
			<?php include "inc/nav.php" ?>

			<section class="section-1">

			</section>
		</div>

	</body>

	</html>

<?php } else {
	$em = "Сначала войдите в аккаунт";
	header("Location: login.php?error=$em");
	exit();
}
?>