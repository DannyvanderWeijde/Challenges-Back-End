<?php 
	include "../index/header.php";
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$listName = test_input($_POST["listName"]);
		
		$sql = "INSERT INTO lists(name) VALUES(:listName)";
		$statement = $pdo->prepare($sql);
		$statement->execute(["listName" => $listName]);

		header("Location: home.php");
		die();
	}

	function test_input($data){
	  $data = trim($data); //Zorgt ervoor dat onnodige space, tab, newline worden weggehaald.
	  $data = stripslashes($data); //verwijderd backslashes (\).
	  $data = htmlspecialchars($data); //Dit zorgt ervoor dat speciale karakters naar html veranderd waardoor je niet gehackt kan worden.
	  return $data;
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