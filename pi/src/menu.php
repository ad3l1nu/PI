<?php
session_start();
if (isset($_SESSION['user_data']) == "") {
	?>
	<li><a href="index.php">Pagina principală</a></li>
	<li><a href="features.php">Caracteristici</a></li>
	<li><a href="aboutUs.php">Despre noi</a></li>
	<li><a href="service.php">Servicii</a></li>
	<li><a href="gallery.php">Galerie</a></li>
	<li><a href="register.php">Înregistrare</a></li>
	<li><a href="signin.php">Autentificare</a></li>
	<li><a href="contact.php">Contact</a></li>
	<?php
} else if ($_SESSION['user_type'] == "client") {
	?>
		<li><a href="index.php">Pagina principală</a></li>
		<li><a href="features.php">Caracteristici</a></li>
		<li><a href="aboutUs.php">Despre noi</a></li>
		<li><a href="service.php">Servicii</a></li>
		<li><a href="gallery.php">Galerie</a></li>
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Profilul meu <span
					class="fa fa-angle-down"></span></a>
			<ul class="dropdown-menu" role="menu">
				<li><a href="viewprofile.php">Vizualizare Profil </a></li>
				<li><a href="editprofile.php">Editare Profil</a></li>
				<li><a href="appointments.php">Programările mele</a></li>
			</ul>
		</li>
		<li><a href="logout.php">Deconectare</a></li>
		<li><a href="contact.php">Contact</a></li>
	<?php
} else if ($_SESSION['user_type'] == "admin") {
	?>
			<li><a href="index.php">Pagina principală</a></li>
			<li><a href="update.php">Actualizare</a></li>
			<li><a href="upload.php">Încărcare</a></li>
			<li><a href="stat.php">Statistici test</a></li>
			<li><a href="editprofile.php">Editare Profil</a></li>
			<li><a href="logout.php">Deconectare</a></li>
	<?php
} else if ($_SESSION['user_type'] == "doctor") {
	?>
				<li><a href="index.php">Pagina principală</a></li>
				<li><a href="appointments.php">Programările mele</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Profilul meu <span
							class="fa fa-angle-down"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="viewprofile.php">Vizualizare Profil </a></li>
						<li><a href="editprofile.php">Editare Profil</a></li>
					</ul>
				</li>
				<li><a href="logout.php">Deconectare</a></li>
	<?php
}
