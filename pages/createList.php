<?php 
	include "../index/header.php";
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		createList();
	}
?>
<body>
	<div class="createContainer">
		<div class="contentContainer">
			<h1>
				Voeg een lijst toe!
			</h1>
			<p>
				Vul de gegevens hieronder in om een lijst aan te maken.
			</p>
			<form method="POST">
				<div class="inputBox">
					<p>Naam lijst</p>
					<input type="text" name="listName" required>
				</div>
				<button type="submit">
					Aanmaken
				</button>
			</form>
		</div>
	</div>
</body>
<?php include "../index/footer.php" ?>