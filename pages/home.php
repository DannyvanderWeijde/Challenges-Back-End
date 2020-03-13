<?php 
// Nagekeken door Jesse Sommeling 91102801 13/03/2020
// Probeer de pdo statements (querys) te scheiden van de rest van je code in een aparte php file.
// Probeer de form validation te scheiden van je code door het in een apart bestand te zetten.
// Probeer DRY toe te passen. In dit geval: bijvoorbeeld je form validation generiek te maken (in één function als dat kan, bijvoorbeeld).
// Ziet er erg netjes uit! Ik zou willen dat ik in mijn eigen project sommige problemen had opgelost zoals jij dat hebt gedaan, chapeau! :)
	include "../index/header.php";
	$statement = getAllLists();
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
									<a class="planningSortMinTime" href="home.php?row=<?php echo $row["id"] ?>&minTime=30" title="Sorteer deze lijst op taken die 30 min of langer duren.">
										30+
									</a>
									<a class="planningSortMinTime" href="home.php?row=<?php echo $row["id"] ?>&minTime=60" title="Sorteer deze lijst op taken die 60 min of langer duren.">
										60+
									</a>
									<a class="planningSortCancel" href="home.php" title="Sorteer deze lijst weer als normaal.">
										<i class="fas fa-times"></i>
									</a>
								</div>
								<button class="statusInfoBar" onclick="getListWithTasks('<?php echo $row["id"] ?>')">
									Status
								</button>
								<a class="planningSortStatusCheck" href="home.php?row=<?php echo $row["id"] ?>&sort=Gedaan" title="Sorteer deze lijst op taken die al gedaan zijn.">
									<i class="fas fa-check"></i>
								</a>
								<a class="planningSortStatusUncheck" href="home.php?row=<?php echo $row["id"] ?>&sort=Nog doen" title="Sorteer deze lijst op taken die nog niet gedaan zijn.">
									<i class="fas fa-hourglass-half"></i>
								</a>
								<a class="planningSortCancel" href="home.php" title="Sorteer deze lijst weer als normaal.">
									<i class="fas fa-times"></i>
								</a>
							</div>
							<hr>
							<?php 
								$taskStatement = getTasksByList($row["id"]);
							?>
							<?php while ($row2 = $taskStatement->fetch()){ ?>
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
