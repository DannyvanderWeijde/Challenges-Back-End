<?php 
	include "../index/header.php";
	$id = $_GET["number"];
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		createTask($id);
	}
?>
<body>
	<div class="createContainer">
		<div class="contentContainer">
			<h1>
				Voeg een taak toe!
			</h1>
			<p>
				Vul de gegevens hieronder in om een taak aan te maken.
			</p>
			<form method="POST">
				<div class="inputBox">
					<p>Taak beschrijving</p>
					<input type="text" name="task" required>
				</div>
				<div class="inputBox">
					<p>Tijdsduur (min)</p>
					<input type="number" name="time">
				</div>
				<div class="inputBox">
					<p>Status (Als je deze taak nog moet doen hou het vakje leeg. Heb je deze taak al afgerond vul dan het vakje in.)</p>
					<input type="checkbox" name="status">
				</div>
				<button type="submit">
					Aanmaken
				</button>
			</form>
		</div>
	</div>
</body>
<?php include "../index/footer.php" ?>