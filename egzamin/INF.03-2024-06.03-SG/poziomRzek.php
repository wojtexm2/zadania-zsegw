<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="UTF-8">
		<title>Poziomy rzek</title>

		<link rel="stylesheet" href="styl.css">
	</head>
	<body>
		<?php
			$conn = mysqli_connect("localhost", "root", "", "rzeki");
		?>

		<header><img src="obraz1.png" alt="Mapa Polski"></header>
		<header><h1>Rzeki w województwie dolnośląskim</h1></header>

		<nav>
			<form action="poziomRzek.php" method="POST">
				<input type="radio" name="stan" value="s_wszystkie"><label class="poziom">Wszystkie</label>
				<input  type="radio" name="stan" value="s_ostrzegawczy"><label class="poziom">Ponad stan ostrzegawczy</label>
				<input  type="radio" name="stan" value="s_alarmowy"><label class="poziom">Ponad stan alarmowy</label>
				<button type="submit">Pokaż</button>
			</form>
		</nav>

		<section>
			<h3>Stany na dzień 2022-05-05</h3>
			<table>
				<tr>
					<th>Wodomierz</th><th>Rzeka</th><th>Ostrzegawczy</th><th>Alarmowy</th><th>Aktualny</th>
				</tr>
				<?php
					if (isset($_POST["stan"]) && $_POST["stan"]) {
						$radio_val = $_POST["stan"];
						if ($radio_val == "s_wszystkie") {
							$query = "SELECT w.nazwa, w.rzeka, w.stanOstrzegawczy, w.stanAlarmowy, p.stanWody FROM wodowskazy w JOIN pomiary p ON w.id = p.wodowskazy_id WHERE p.dataPomiaru LIKE '2022-05-05';";
						}
						else if($radio_val == "s_ostrzegawczy") {
							$query = "SELECT w.nazwa, w.rzeka, w.stanOstrzegawczy, w.stanAlarmowy, p.stanWody FROM wodowskazy w JOIN pomiary p ON w.id = p.wodowskazy_id WHERE p.dataPomiaru LIKE '2022-05-05' AND p.stanWody > w.stanOstrzegawczy;
";
						}
						else if($radio_val == "s_alarmowy") {
							$query = "SELECT w.nazwa, w.rzeka, w.stanOstrzegawczy, w.stanAlarmowy, p.stanWody FROM wodowskazy w JOIN pomiary p ON w.id = p.wodowskazy_id WHERE p.dataPomiaru LIKE '2022-05-05' AND p.stanWody > w.stanAlarmowy;
";
						}
						$res = mysqli_query($conn, $query);
						while($row = mysqli_fetch_row($res)) {
							echo "<tr><td>{$row[0]}</td><td>{$row[1]}</td><td>{$row[2]}</td><td>{$row[3]}</td><td>{$row[4]}</td></tr>";
						}
					}
				?>
			</table>
		</section>
		<aside>
			<h3>Informacje</h3>
			<ul>
				<li>Brak ostrzeżeń o burzach z gradem</li>
				<li>Smog w mieście Wrocław</li>
				<li>Silny wiatr w Karkonoszach</li>
			</ul>
			<h3>
				Średnie stany wód
			</h3>
			<?php
				$res = mysqli_query($conn, "SELECT p.dataPomiaru, AVG(p.stanWody) FROM pomiary p GROUP BY p.dataPomiaru;");
				while ($row = mysqli_fetch_row($res)) {
					echo "<p>{$row[0]}: {$row[1]}</p>";
				}
			?>
			<a href="https://komunikaty.pl">Dowiedz się więcej</a>
			<img src="obraz2.jpg" alt="rzeka">
		</aside>
		
		<footer><p>Stronę wykonał: 000000000</p></footer>

		<?php
			mysqli_close($conn);
		?>
	</body>
</html>












