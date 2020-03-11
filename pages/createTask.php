<?php 
	include "../index/header.php";
	$id = $_GET["number"];
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$task = test_input($_POST["task"]);
		$time = test_input($_POST["time"]);

		if(isset($_POST["status"])){
			$statusText = "Gedaan";
		}else{
			$statusText = "Nog doen";
		}

		$sql = "INSERT INTO tasks(task,length_of_time,status,list_id) VALUES(:task, :length_of_time, :status, :list_id)";
		$statement = $pdo->prepare($sql);
		$statement->execute(["task" => $task, "length_of_time" => $time, "status" => $statusText, "list_id" => $id]);

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