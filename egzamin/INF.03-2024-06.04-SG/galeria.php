<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="UTF-8">
		<title>Galeria</title>

		<link rel="stylesheet" href="styl.css">
	</head>
	<body>
		<?php
			$conn = mysqli_connect("localhost", "root", "", "galeria");
		?>

		<header><h1>Zdjęcia</h1></header>

		<aside id="left">
			<h2>Tematy zdjęć</h2>
			<ol>
				<li>Zwierzęta</li>
				<li>Krajobrazy</li>
				<li>Miasta</li>
				<li>Przyroda</li>
				<li>Samochody</li>
			</ol>
		</aside>

		<section>
			<!-- skrypt 1 -->
			<?php
				$res = mysqli_query($conn, "SELECT z.tytul, z.plik, z.polubienia, a.imie, a.nazwisko FROM zdjecia z JOIN autorzy a ON z.autorzy_id = a.id ORDER BY a.nazwisko ASC;");

				while($row = mysqli_fetch_row($res)) {
					echo "<div id='image_holder'>
					 	<img src='$row[1]' alt='zdjęcie'>
						<h3>{$row[0]}</h3>";

					if($row[2] > 40) {
						echo "<p>Autor: {$row[3]} {$row[4]}.<br>
						Wiele osób polubiło ten obraz.</p>";
					}
					else {
						echo "<p>Autor: {$row[3]} {$row[4]}</p>";
					}

					echo "<a href='{$row[1]}' download>Pobierz</a></div>";
				}
			?>
		</section>

		<aside id="right">
			<h2>Najbardziej lubiane</h2>
			<! -- skrypt 2 -->
			<?php
				$res = mysqli_query($conn, "SELECT tytul, plik FROM zdjecia WHERE polubienia >= 100;");

				while($row = mysqli_fetch_row($res)) {
					echo "<img src='{$row[1]}' alt='{$row[0]}'>";
				}
 			?>
			<strong>Zobacz wszystkie nasze zdjęcia</strong>
		</aside>

		<footer><h5>Stronę wykonał: 000000000</h5></footer>

		<?php
			mysqli_close($conn);
		?>
	</body>
</html>