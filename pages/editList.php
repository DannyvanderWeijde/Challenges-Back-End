<?php 
	include "../index/header.php";
	$id = $_GET["number"];
	$edited = false;
	$sql = "SELECT * FROM Lists WHERE id = :id";
	$statement = $pdo->prepare($sql);
	$statement->execute(["id" => $id]); 
	$statement = $statement->fetch();

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$name = test_input($_POST["name"]);

		$sql2 = "UPDATE lists SET name = :name WHERE id = :id";
		$statement2 = $pdo->prepare($sql2);
		$statement2->execute(["name" => $name, "id" => $id]);
		$edited = true;
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
				Pas uw lijst aan!
			</h1>
			<p>
				Vul de gegevens hieronder in om uw lijst aan te passen.
			</p>
			<form method="POST">
				<div class="inputBox">
					<p>Naam lijst</p>
					<input type="text" name="name" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : $statement["name"]?>" required>
				</div>
				<button type="submit">
					Aanpassen
				</button>
			</form>
			<?php if($edited == true){ ?>
				<div class="added">
					Lijst is aangepast!
				</div>
			<?php } ?>
		</div>
	</div>
</body>
<?php include "../index/footer.php" ?>