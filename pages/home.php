<?php 
	include "../index/header.php";
	$statement = $pdo->query("SELECT * FROM lists");
	echo $_GET["row"];
	echo $_GET["sort"];
?>
<body>
	<div class="headerImgContainer">
		<img src="../images/header-photo.jpeg" alt="header">
	</div>
	<div class="planningContainer">
		<div class="contentContainer">
			<div class="planningButtonContainer">
				<a class="planningButtonLink" href="createList.php">
					<button>
						Lijst toevoegen
					</button>
				</a>
			</div>
			<?php while ($row = $statement->fetch()){ ?>
				<div class="planningListContainer">
					<div class="planningItemContainer">
						<div class="planningItem">
							<h3>
								<?php echo $row["name"]?>
							</h3>
							<a class="planningLinks" href="editList.php?number=<?php echo $row["id"] ?>">
								<i class="far fa-edit"></i>
							</a>
							<a class="planningLinks" href="deleteList.php?number=<?php echo $row["id"] ?>">
								<i class="far fa-trash-alt"></i>
							</a>
						</div>
						<div class="planningTasks" id="<?php echo $row["id"] ?>">
							<div class="planningTasksInfoBar">
								<div class="taskInfoBar">
									Taak
								</div>
								<div class="timeInfoBar">
									Tijdsduur
									<a href="home.php?row=<?php echo $row["id"] ?>&minTime=30">
										30+
									</a>
									<a href="home.php?row=<?php echo $row["id"] ?>&minTime=60">
										60+
									</a>
									<a href="home.php">
										<i class="fas fa-times"></i>
									</a>
								</div>
								<button class="statusInfoBar" onclick="getListWithTasks('<?php echo $row["id"] ?>')">
									Status
								</button>
								<a href="home.php?row=<?php echo $row["id"] ?>&sort=done">
									<i class="fas fa-check"></i>
								</a>
								<a href="home.php?row=<?php echo $row["id"] ?>&sort=undone">
									<i class="fas fa-hourglass-half"></i>
								</a>
								<a href="home.php">
									<i class="fas fa-times"></i>
								</a>
							</div>
							<hr>
							<?php 
								$statement2 = $pdo->query("SELECT * FROM tasks WHERE list_id=$row[id] ORDER BY tasks.task_id ASC");
							?>
							<?php while ($row2 = $statement2->fetch()){ ?>
								<div class="planningTaskContainer">
									<div class="task">
										<?php echo $row2["task"]?>
									</div>
									<div class="time">
										<?php echo $row2["length_of_time"]?>
									</div>
									<div class="status">
										<?php echo $row2["status"]?>
									</div>
									<a class="planningLinks" href="editTask.php?number=<?php echo $row2["task_id"] ?>">
										<i class="far fa-edit"></i>
									</a>
									<a class="planningLinks" href="deleteTask.php?number=<?php echo $row2["task_id"] ?>">
										<i class="far fa-trash-alt"></i>
									</a>
								</div>
								<hr>
							<?php } ?>
							<div class="listButtonContainer">
								<a class="planningButtonLink" href="createTask.php?number=<?php echo $row["id"] ?>">
									<button>
										taak toevoegen
									</button>
								</a>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</body>
<?php include "../index/footer.php" ?>
