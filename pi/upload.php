<?php
include('src/functions.php');
include('src/config.php');
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<title>MediCare Hub : Încarcă</title>
		<?php include('src/head.php') ?>
	</head>

	<body>

		<?php include('src/preload.php') ?>
		<!--=========== BEGIN HEADER SECTION ================-->
		<?php include('src/header.php') ?>
		<!--=========== END HEADER SECTION ================-->

		<?php
		include('src/session_check.php');
		echo youAreHere("Upload");
		?>

		<section id="service">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="service-area">
							<!-- Start Service Title -->
							<div class="section-heading">
								<h2>Programare pentru test</h2>
								<div class="line"></div>
							</div>
							<div class="service-content">
								<div class="row">
									<div class="col-lg-12 col-md-12">
										<table class="table table-hover">
											<thead>
												<tr>
													<th>Test</th>
													<th>Data</th>
													<th>Ora</th>
													<th>Încarcă</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$sql = mysqli_query($con, "SELECT * FROM test_appointment ");
												while ($row = mysqli_fetch_array($sql)) {
													$test = $row['test_id'];
													$sql2 = mysqli_query($con, "SELECT * FROM test WHERE id='$test' ");
													$row2 = mysqli_fetch_array($sql2);
													?>
													<tr>
														<th scope="row">
															<?= $row2['test_name'] ?>
														</th>
														<td>
															<?= $row['test_date'] ?>
														</td>
														<td>
															<?= $row['test_time'] ?>
														</td>
														<td><a href="uploadcode.php?data=test&id=<?= $row['id'] ?>">Încarcă</a>
														</td>
													</tr>
													<?php
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section id="service">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="service-area">
							<!-- Start Service Title -->
							<div class="section-heading">
								<h2>Programare la medic</h2>
								<div class="line"></div>
							</div>
							<div class="service-content">
								<div class="row">
									<div class="col-lg-12 col-md-12">
										<table class="table table-hover">
											<thead>
												<tr>
													<th>Doctor</th>
													<th>Pacient</th>
													<th>Data</th>
													<th>Ora</th>
													<th>Încarcă</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$sql = mysqli_query($con, "SELECT * FROM doctor_app");
												while ($row = mysqli_fetch_array($sql)) {
													$doc = $row['doctor_id'];
													$sql2 = mysqli_query($con, "SELECT * FROM doctor WHERE id='$doc' ");
													$row2 = mysqli_fetch_array($sql2);
													$user = $row['users_id'];
													$sql3 = mysqli_query($con, "SELECT * FROM client WHERE id='$user' ");
													$row3 = mysqli_fetch_array($sql3);
													?>
													<tr>
														<th scope="row">
															<?= $row2['name'] ?>
														</th>
														<td>
															<?= $row3['name'] ?>
														</td>
														<td>
															<?= $row['app_date'] ?>
														</td>
														<td>
															<?= $row['app_time'] ?>
														</td>
														<td><a href="uploadcode.php?data=doctor&id=<?= $row['id'] ?>">Încarcă</a>
														</td>
													</tr>
													<?php
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!--=========== Start Footer SECTION ================-->
		<?php include('src/footer.php') ?>
		<!--=========== End Footer SECTION ================-->

		<?php include('src/incfooter.php') ?>
	</body>

</html>
