<?php
if(isset($_POST["Delete_Employer"])){
	foreach($_POST["Delete_Employer"] as $id){
		$conn = new PDO("mysql:host=localhost;dbname=Recruitment_Agency", "root", "mypassword");
		$sql = "DELETE FROM Link WHERE id_Employer = :id_Employer";
		$stmt = $conn -> prepare($sql);
		$stmt -> bindValue(":id_Employer", $id, PDO::PARAM_INT);
		$stmt -> execute();
		$conn = null;
	}
	foreach($_POST["Delete_Employer"] as $id){
		$conn = new PDO("mysql:host=localhost;dbname=Recruitment_Agency", "root", "mypassword");
		$sql = "DELETE FROM Employer WHERE id_Employer = :id_Employer";
		$stmt = $conn -> prepare($sql);
		$stmt -> bindValue(":id_Employer", $id, PDO::PARAM_INT);
		$stmt -> execute();
		$conn = null;
	}
}
if(isset($_POST["Delete_Employee"])){
	foreach($_POST["Delete_Employee"] as $id){
		$conn = new PDO("mysql:host=localhost;dbname=Recruitment_Agency", "root", "mypassword");
		$sql = "DELETE FROM Link WHERE id_Employee = :id_Employee";
		$stmt = $conn -> prepare($sql);
		$stmt -> bindValue(":id_Employee", $id, PDO::PARAM_INT);
		$stmt -> execute();
		$conn = null;
	}
	foreach($_POST["Delete_Employee"] as $id){
		$conn = new PDO("mysql:host=localhost;dbname=Recruitment_Agency", "root", "mypassword");
		$sql = "DELETE FROM Employee WHERE id_Employee = :id_Employee";
		$stmt = $conn -> prepare($sql);
		$stmt -> bindValue(":id_Employee", $id, PDO::PARAM_INT);
		$stmt -> execute();
		$conn = null;
	}
}
echo "<h1>Список сотрудников</h1>";
echo "<form action ='Delete_Users.php' method='POST'>";
	echo "<table>";
		echo "<tr><th>ID</th><th>Фамилия</th><th>Имя</th><th>Отчество</th><th>Удалить</th></tr>";
		//Сотрудники
		$conn = new PDO("mysql:host=localhost;dbname=Recruitment_Agency", "root", "mypassword");
		$sql = "SELECT * FROM Employee";
		$stmt = $conn -> prepare($sql);
		$stmt -> execute();
		foreach($stmt as $row){
			echo "<tr>";
				//ID
				echo "<td>" . $row["id_Employee"] . "</td>";
				//Фамилия
				echo "<td>" . $row["surname"] . "</td>";
				//Имя
				echo "<td>" . $row["name"] . "</td>";
				//Отчество
				echo "<td>" . $row["middlename"] . "</td>";
				//Флаг удаления
				echo "<td>";
					echo "<input type='checkbox' name='Delete_Employee[]' value='" . $row["id_Employee"] . "'>";
				echo "</td>";
			echo "<tr>";
		}
		$conn = null;
	echo "</table>";
		
	echo "<h1>Список работодателей</h1>";
		echo "<table>";
		echo "<tr><th>ID</th><th>Фамилия</th><th>Имя</th><th>Отчество</th><th>Удалить</th></tr>";
		//Работодатели
		$conn = new PDO("mysql:host=localhost;dbname=Recruitment_Agency", "root", "mypassword");
		$sql = "SELECT * FROM Employer";
		$stmt = $conn -> prepare($sql);
		$stmt -> execute();
		foreach($stmt as $row){
			echo "<tr>";
				//ID
				echo "<td>" . $row["id_Employer"] . "</td>";
				//Фамилия
				echo "<td>" . $row["surname"] . "</td>";
				//Имя
				echo "<td>" . $row["name"] . "</td>";
				//Отчество
				echo "<td>" . $row["middlename"] . "</td>";
				//Флаг удаления
				echo "<td>";
					echo "<input type='checkbox' name='Delete_Employer[]' value='" . $row["id_Employer"] . "'>";
				echo "</td>";
			echo "<tr>";
			$conn = null;
		}
		echo "</table>";
	echo "<p><input type='submit' value='Удалить выбранные элементы'></p>";
echo "</form>";
echo "<form action='Rec_form.php'>
		<input type='submit' value='На страницу профайлинга'>
	  </form>";
?>
