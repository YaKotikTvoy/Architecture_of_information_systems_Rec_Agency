<?php
$conn = new PDO("mysql:host=localhost;dbname=Recruitment_Agency", "root", "mypassword");
$sql = "SELECT surname, middlename, name FROM Employee";
$stmt = $conn -> prepare($sql);
$stmt -> execute();
echo "<table><tr><th>Фамилия</th><th>Имя</th><th>Отчество</th><th></th></tr>";
foreach($stmt as $row){
	echo "<tr>";
		echo "<td>" . $row["surname"] . "</td>";
		echo "<td>" . $row["name"] . "</td>";
		echo "<td>" . $row["middlename"] . "</td>";
		echo "<td><form method='POST' action='Create_Resume.php'>";
			echo "<input type='hidden' name='surname' value='" . $row["surname"] . "'/>";
			echo "<input type='hidden' name='name' value='" . $row["name"] . "'/>";
			echo "<input type='hidden' name='middlename' value='" . $row["middlename"] . "'/>";
			
			echo "<input type='hidden' name='id_Recruiter' value='" . $_POST["id_Recruiter"] . "'>";
			echo "<input type='hidden' name='password' value='" . $_POST["password"] . "'>";
			
			echo "<input type='submit' value='Редактировать/Создать резюме'/>";
		echo "</form></td>";
	echo "</tr>";
}
echo "</table>";
echo "<form action='Rec_form.php' method='POST'>
		<input type='hidden' name='id_Recruiter' value='" . $_POST["id_Recruiter"] . "'>
		<input type='hidden' name='password' value='" . $_POST["password"] . "'>
		<input type='submit' value='На страницу профайлинга'/>
	  </form>";
?>
