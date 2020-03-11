<?php 
	include "../index/header.php";
	$id = $_GET["number"];

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$sql = "DELETE FROM tasks WHERE task_id = :id";
		$statement = $pdo->prepare($sql);
		$statement->execute(["id" => $id]);

		header("Location: home.php");
		die();
	}
?>
<body>
	<div class="createContainer">
		<div class="contentContainer">
			<h1>
				Weet u zeker dat u deze taak wilt verwijderen?
			</h1>
			<p>
				Als u deze taak verwijderd kunt u deze niet meer terug krijgen.
			</p>
			<form class="deleteForm" method="POST">
				<button type="submit">
					Verwijderen
				</button>
			</form>
			<a class="deleteBackButton" href="home.php">
				<button>
					Terug
				</button>
			</a>
		</div>
	</div>
</body>
<?php include "../index/footer.php" ?>