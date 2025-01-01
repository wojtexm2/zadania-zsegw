<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="UTF-8">
		<title>Komis aut</title>

		<link rel="stylesheet" href="styl.css">
	</head>
	<body>
		<?php
			$conn = mysqli_connect("localhost", "root", "", "kupauto");
		?>

		<header><h1><em>KupAuto!</em> Internetowy Komis Samochodowy</h1></header>

		<section id="first">
			<!-- skrypt 1 -->
			<?php
				$res = mysqli_query($conn, "SELECT model, rocznik, przebieg, paliwo, cena, zdjecie FROM samochody WHERE id = 10;");
				$row = mysqli_fetch_row($res);

				echo "
					<img src='{$row[5]}' alt='oferta dnia'>
					<h4>Oferta Dnia: Toyota {$row[0]}</h4>
					<p>Rocznik: {$row[1]}, przebieg: {$row[2]}, rodzaj paliwa: {$row[3]}</p>
					<h4>Cena: {$row[4]}</h4>
				";
			?>
		</section>

		<section id="second">
			<h2>Oferty Wyróżnione</h2>
			<!-- skrypt 2 -->
			<?php
				$res = mysqli_query($conn, "SELECT m.nazwa, s.model, s.rocznik, s.cena, s.zdjecie FROM samochody s JOIN marki m ON s.marki_id = m.id WHERE s.wyrozniony LIMIT 4;");
			while($row = mysqli_fetch_row($res)) {
				echo "
					<div id='offer'>
						<img src='{$row[4]}' alt='$row[1]'>
						<h4>{$row[0]} {$row[1]}</h4>
						<p>Rocznik: {$row[2]}</p>
						<h4>Cena:{$row[3]}</h4>
					</div>
				";
			}
				
			?>
		</section>

		<section id="third">
			<h2>Wybierz markę</h2>
			<form method="POST" action="KupAuto.php">
				<select name="marki">
					<!-- skrypt 3 -->
					<?php
						$res = mysqli_query($conn, "SELECT nazwa FROM marki;");
						while($row = mysqli_fetch_row($res)) {
							echo "<option value='{$row[0]}'>{$row[0]}</option>";
						}
					?>
					
				</select>
				<button type="submit">Wyszukaj</button>
			</form>
			<!-- skrypt 4 -->
			<?php
				if(isset($_POST["marki"])) {
					$res = mysqli_query($conn, "SELECT s.model, s.cena, s.zdjecie FROM marki m JOIN samochody s ON s.marki_id = m.id WHERE m.nazwa = '{$_POST['marki']}';");
					while($row = mysqli_fetch_row($res)) {
						echo "
							<div id='offer'>
								<img src='{$row[2]}' alt='0'>
								<h4>{$_POST['marki']} {$row[0]}</h4>
								<h4>Cena: {$row[1]}</h4>
							</div>
						";
					}
				}
			?>
		</section>

		<footer>
			<p>Stronę wykonał: 000000000</p>
			<p><a href=" http://firmy.pl/komis">Znajdź nas także</a></p>
		</footer>

		<?php
			mysqli_close($conn);
		?>
	</body>
</html>