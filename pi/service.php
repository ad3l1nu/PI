<?php
include('src/functions.php');
include('src/config.php');
?>
<!DOCTYPE html>
<html lang="en">

	<head>
            <title>MediCare Hub : Servicii</title>
		<?php include('src/head.php') ?>
	</head>

	<body>
		<?php include('src/preload.php') ?>
		<!--=========== BEGIN HEADER SECTION ================-->
		<?php include('src/header.php') ?>
		<!--=========== END HEADER SECTION ================-->

		<?= youAreHere("Service") ?>

		<section id="service">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="service-area">
							<!-- Start Service Title -->
							<div class="section-heading">
								<h2>Servicii</h2>
								<div class="line"></div>
							</div>
							<div class="service-content">
								<div class="row">
									<div class="col-lg-12 col-md-12">
										<table class="table table-hover">
											<thead>
												<tr>
													<th>Servicii</th>
													<th>Tarife</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$sql = mysqli_query($con, "SELECT * FROM test");
												while ($row = mysqli_fetch_array($sql)) {
													?>
													<tr>
														<th scope="row">
															<?= $row['test_name'] ?>
														</th>
														<td>
															<?= $row['test_cost'] ?>
														</td>
													</tr>
													<?php
												}
												?>
											</tbody>
										</table>
										<div class="readmore_area">
											<a data-hover="Book Now" href="index.php"><span>Programare</span></a>
										</div>
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
