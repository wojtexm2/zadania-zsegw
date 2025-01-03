<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="UTF-8">
		<title>Ważenie samochodów ciężarowych</title>
		<link rel="stylesheet" href="styl.css">
	</head>
	<body>
		<?php
			$conn = mysqli_connect("localhost", "root", "", "wazenietirow");
		?>

		<header id="bannerleft"><h1>Ważenie pojazdów we Wrocławiu</h1></header>
		<header id="bannerright"><img src="obraz1.png" alt="waga"></header>

		<section id="left">
			<h2>Lokalizacje wag</h2>
			<ol>
				<!-- skrypt 1 -->
				<?php
					$res = mysqli_query($conn, "SELECT ulica from lokalizacje;");
					while($row = mysqli_fetch_row($res)) {
						echo "<li>{$row[0]}</li>";
					}
				?>
			</ol>
			<h2>Kontakt</h2>
			<a href="mailto:wazenie@wroclaw.pl">napisz</a>
		</section>
		<section id="middle">
			<h2>Alerty</h2>
			<table>
				<tr><th>rejestracja</th><th>ulica</th><th>waga</th><th>dzień</th><th>czas</th></tr>
			<!-- skrypt 2 -->
			<?php
				$res = mysqli_query($conn, "SELECT w.rejestracja, l.ulica, w.waga, w.dzien, w.czas FROM wagi w JOIN lokalizacje l ON l.id = w.lokalizacje_id WHERE waga > 5;");
			while($row = mysqli_fetch_row($res)) {
				echo "<tr><td>{$row[0]}</td><td>{$row[1]}</td><td>{$row[2]}</td><td>{$row[3]}</td><td>{$row[4]}</td></tr>";
			}
			?>
			</table>
			<!-- skrypt 3 -->
			<?php
				header("refresh: 10");
			?>
		</section>
		<section id="right">
			<img src="obraz2.jpg" alt="tir" id="tir">
		</section>

		<footer>
			<p>Stronę wykonał: 000000000</p>
		</footer>

		<?php
			mysqli_close($conn);
		?>
	</body>
</html>