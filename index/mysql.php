<?php
	function getDbInfo(){
		$host = "localhost";
		$user = "root";
		$password = "mysql";
		$dbname = "challenges-back-end";

		$dsn = "mysql:host=". $host .";dbname=" . $dbname;

		$pdo = new PDO($dsn, $user, $password);
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
		return $pdo;
	}

	function getAllLists(){
		$pdo = getDbInfo();

		$statement = $pdo->query("SELECT * FROM lists");
		return $statement;
	}

	function getList($id){
		$pdo = getDbInfo();

		$sql = "SELECT * FROM Lists WHERE id = :id";
		$statement = $pdo->prepare($sql);
		$statement->execute(["id" => $id]); 
		$statement = $statement->fetch();
		return $statement;
	}

	function getTasksByList($id){
		$pdo = getDbInfo();

		if($_GET["sort"]){
			$_GET["sort"] = '"' . $_GET["sort"] . '"';
		}

		$taskStatement = $pdo->query("SELECT * FROM tasks WHERE list_id=$id ORDER BY tasks.task_id ASC");

		if($_GET["row"]){
			if($_GET["row"] == $id){
				if($_GET["sort"]){
					$taskStatement = $pdo->query("SELECT * FROM tasks WHERE list_id=$id AND status = $_GET[sort]");
				}elseif($_GET["minTime"]){
					$taskStatement = $pdo->query("SELECT * FROM tasks WHERE list_id=$id AND length_of_time >= $_GET[minTime]");
				}
			}
		}
		return $taskStatement;
	}

	function getTask($id){
		$pdo = getDbInfo();

		$sql = "SELECT * FROM tasks WHERE task_id = :id";
		$statement = $pdo->prepare($sql);
		$statement->execute(["id" => $id]); 
		$statement = $statement->fetch();
		return $statement;
	}

	function createList(){
		$pdo = getDbInfo();

		$listName = test_input($_POST["listName"]);
		
		$sql = "INSERT INTO lists(name) VALUES(:listName)";
		$statement = $pdo->prepare($sql);
		$statement->execute(["listName" => $listName]);

		header("Location: home.php");
		die();
	}

	function createTask($id){
		$pdo = getDbInfo();

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

	function editList($id){
		$pdo = getDbInfo();

		$name = test_input($_POST["name"]);

		$sql2 = "UPDATE lists SET name = :name WHERE id = :id";
		$statement2 = $pdo->prepare($sql2);
		$statement2->execute(["name" => $name, "id" => $id]);

		header("Location: home.php");
		die();
	}

	function editTask($id){
		$pdo = getDbInfo();
		
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

		header("Location: home.php");
		die();
	}

	function deleteList($id){
		$pdo = getDbInfo();

		$sql = "DELETE FROM tasks WHERE list_id = :id";
		$statement = $pdo->prepare($sql);
		$statement->execute(["id" => $id]);

		$sql = "DELETE FROM lists WHERE id = :id";
		$statement = $pdo->prepare($sql);
		$statement->execute(["id" => $id]);

		header("Location: home.php");
		die();
	}

	function deleteTask($id){
		$pdo = getDbInfo();

		$sql = "DELETE FROM tasks WHERE task_id = :id";
		$statement = $pdo->prepare($sql);
		$statement->execute(["id" => $id]);

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