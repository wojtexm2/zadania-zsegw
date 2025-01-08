<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="UTF-8">
		<title>Hodowla świnek morskich</title>

		<link rel="stylesheet" href="styl.css">
	</head>
	<body>
		<?php
			$conn = mysqli_connect("localhost", "root", "", "hodowla");
		?>
		<header><h1>Hodowla świnek morskich - zamów świnkowe maluszki</h1></header>

		<aside>
			<h3>Poznaj wszystkie rasy świnek morskich</h3>
			<ol>
				<!-- srypt 1 -->
				<?php
					$res = mysqli_query($conn, "SELECT rasa FROM rasy;");
					while($row = mysqli_fetch_row($res)) {
						echo "<li>{$row[0]}</li>";
					}
				?>
			</ol>
		</aside>

		<nav>
			<a href="peruwianka.php">Rasa Peruwianka</a>
			<a href="american.php">Rasa American</a>
			<a href="crested.php">Rasa Crested</a>
		</nav>

		<main>
			<img src="american.jpg" alt="Świnka morska rasy american">
			<!-- skrypt 2 -->
			<?php
				$res = mysqli_query($conn, "SELECT DISTINCT s.data_ur, s.miot, r.rasa FROM rasy r JOIN swinki s ON r.id = s.rasy_id WHERE r.id = 6;");
				while($row = mysqli_fetch_row($res)) {
					echo "
						<h2>Rasa: {$row[2]}</h2>
						<p>Data urodzenia: {$row[0]}</p>
						<p>Oznaczenie miotu: {$row[1]}</p>
					";
				}
			?>
			<hr>
			<h2>Świnki w tym miocie</h2>
			<!-- skrypt 3 -->
			<?php
				$res = mysqli_query($conn, "SELECT DISTINCT s.imie, s.cena, s.opis FROM swinki s WHERE s.rasy_id = 6;");
				while($row = mysqli_fetch_row($res)) {
					echo "
						<h3>{$row[0]} - {$row[0]} zł</h3>
						<p>{$row[2]}</p>
					";
				}
			?>
		</main>

		<footer>
			<p>Stronę wykonał: 000000000</p>
		</footer>

		<?php
			mysqli_close($conn);
		?>
	</body>
</html>