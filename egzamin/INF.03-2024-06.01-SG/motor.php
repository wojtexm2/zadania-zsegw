<!DOCTYPE html>
<html lang="pl">
	<?php
		$conn = mysqli_connect("localhost", "root", "", "motory");
	?>

	<head>
		<meta charset="UTF-8">
		<title>Motocykle</title>

		<link href="styl.css" rel="stylesheet">
	</head>
	<body>
		<img alt="motocykl" src="motor.png" id="motor">
		<header><h1>Motocykle - moja pasja</h1></header>
		
		<section id="lewy">
			<h2>Gdzie pojechać?</h2>
			<dl>
				<!-- skrypt 1 -->
				<?php
					$res = mysqli_query($conn, "SELECT w.nazwa, w.opis, w.poczatek, z.zrodlo FROM wycieczki w JOIN zdjecia z ON z.id = w.zdjecia_id");
					while($row = mysqli_fetch_row($res)) {
						echo "<dt>{$row[0]}, rozpoczyna się w {$row[2]}, <a href='{$row[3]}.jpg'>zobacz zdjęcie</a></dt><dd>{$row[1]}</dd>";
					}
				?>
			</dl>
		</section>
		
		<aside id="prawy">
			<h2>Co kupić?</h2>
			<ol>
				<li>Honda CBR125R</li>
				<li>Yamaha YBR125</li>
				<li>Honda VFR800i</li>
				<li>Honda CBR1100XX</li>
				<li>BMW R1200GS LC</li>
			</ol>
		</aside>
		<aside id="prawy">
			<h2>Statystyki</h2>
			<p>
				Wpisanych wycieczek: 
				<!-- skrypt 2 -->
				<?php
					$res = mysqli_query($conn, "SELECT COUNT(id) FROM wycieczki;");				$row = mysqli_fetch_row($res);
					echo "{$row[0]}";
				?>
			</p>
			<p>Użytkowników forum: 200</p>
			<p>Pozostałych zdjęć: 1300</p>
		</aside>

		<footer>
			Stronę wykonał: 000000000
		</footer>
	</body>

	<?php
		mysqli_close($conn);
	?>
</html>