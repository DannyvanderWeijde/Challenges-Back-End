<?php 
	include "../index/header.php";
	$id = $_GET["number"];

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		deleteTask($id);
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