<?php 
	include "../index/header.php";
	$id = $_GET["number"];
	$statement = getList($id);
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		editList($id);
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
		</div>
	</div>
</body>
<?php include "../index/footer.php" ?>