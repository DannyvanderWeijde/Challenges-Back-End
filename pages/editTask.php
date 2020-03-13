<?php 
	include "../index/header.php";
	$id = $_GET["number"];
	$statement = getTask($id);
	
	$checked = $statement["status"];
	if($checked == "Gedaan"){
		$checked = true;
	}else{
		$checked = false;
	}

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		editTask($id);
	}
?>
<body>
	<div class="createContainer">
		<div class="contentContainer">
			<h1>
				Pas uw taak aan!
			</h1>
			<p>
				Vul de gegevens hieronder in om uw taak aan te passen.
			</p>
			<form method="POST">
				<div class="inputBox">
					<p>Taak beschrijving</p>
					<input type="text" name="task" value="<?php echo isset($_POST["task"]) ? $_POST["task"] : $statement["task"]?>" required>
				</div>
				<div class="inputBox">
					<p>Tijdsduur (min)</p>
					<input type="number" name="time" value="<?php echo isset($_POST["time"]) ? $_POST["time"] : $statement["length_of_time"]?>">
				</div>
				<div class="inputBox">
					<p>Status (Als je deze taak nog moet doen hou het vakje leeg. Heb je deze taak al afgerond vul dan het vakje in.)</p>
					<input type="checkbox" name="status" <?php if($checked == true){?> checked <?php } ?>>
				</div>
				<button type="submit">
					Aanpassen
				</button>
			</form>
		</div>
	</div>
</body>
<?php include "../index/footer.php" ?>