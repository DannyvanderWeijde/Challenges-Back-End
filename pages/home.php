<?php 
	$host = "localhost";
	$user = "root";
	$password = "mysql";
	$dbname = "challenges-back-end";

	$dsn = "mysql:host=". $host .";dbname=" . $dbname;

	$pdo = new PDO($dsn, $user, $password);
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

	$statement = $pdo->query("SELECT * FROM lists");
?>
<?php include "../index/header.php" ?>
<body>
	<div class="headerImgContainer">
		<div class="headerTextContainer">
			<h1>
				Challenge back end <br>
				ToDo list
			</h1>
			<p>
				-item 1 <br>
				-item 2	<br>
				-item 3	<br>
			</p>
		</div>
		<img src="../images/header-photo.jpeg" alt="header">
	</div>
	<div class="planningContainer">
		<div class="contentContainer">
			<?php while ($row = $statement->fetch()){ ?>
				<div class="planningItemContainer">
					<a class="planningMainLink" href="#">
						<div class="planningItem">
							<h3>
								<?php echo $row["name"]?>
							</h3>
							<span>
								<?php echo $row["date_made"]?>
							</span>
						</div>
					</a>
					<a class="planningLinks" href="edit.php?number=<?php echo $row["id"] ?>">
						<i class="far fa-edit"></i>
					</a>
					<a class="planningLinks" href="delete.php?number=<?php echo $row["id"] ?>">
						<i class="far fa-trash-alt"></i>
					</a>
				</div>
			<?php } ?>
		</div>
	</div>
</body>
<?php include "../index/footer.php" ?>
