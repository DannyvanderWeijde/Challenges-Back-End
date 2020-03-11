<?php 
	include "../index/header.php";
	$id = $_GET["number"];
	$edited = false;
	$sql = "SELECT * FROM tasks WHERE task_id = :id";
	$statement = $pdo->prepare($sql);
	$statement->execute(["id" => $id]); 
	$statement = $statement->fetch();

	$checked = $statement["status"];
	if($checked == "Gedaan"){
		$checked = true;
	}else{
		$checked = false;
	}

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$task = test_input($_POST["task"]);
		$time = test_input($_POST["time"]);

		if(isset($_POST["status"])){
			$statusText = "Gedaan";
			$checked = true;
		}else{
			$statusText = "Nog doen";
			$checked = false;
		}

		$sql2 = "UPDATE tasks SET task = :task, length_of_time = :length_of_time, status = :status WHERE task_id = :id";
		$statement2 = $pdo->prepare($sql2);
		$statement2->execute(["task" => $task, "length_of_time" => $time, "status" => $statusText, "id" => $id]);
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
			<?php if($edited == true){ ?>
				<div class="added">
					Taak is aangepast!
				</div>
			<?php } ?>
		</div>
	</div>
</body>
<?php include "../index/footer.php" ?>