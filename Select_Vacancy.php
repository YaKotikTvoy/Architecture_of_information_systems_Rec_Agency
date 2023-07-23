<?php
$conn = new PDO("mysql:host=localhost;dbname=Recruitment_Agency", "root", "mypassword");
$sql = "SELECT surname, name, middlename FROM Employer";
$stmt = $conn -> prepare($sql);
$stmt -> execute();
echo "<table>
		<tr><th>Фамилия</th><th>Имя</th><th>Отчество</th><th></th></tr>";
foreach($stmt as $row){
	echo "<tr>
			<td>" . $row["surname"] . "</td>
			<td>" . $row["name"] . "</td>
			<td>" . $row["middlename"] . "</td>
			<td><form action='Create_Vacancy.php' method='POST'>
					<input type='hidden' name='surname' value='" . $row["surname"] . "'>
					<input type='hidden' name='name' value='" . $row["name"] . "'>
					<input type='hidden' name='middlename' value='" . $row["middlename"] . "'>
					
					
					<input type='hidden' name='id_Recruiter' value='" . $_POST["id_Recruiter"] . "'>
					<input type='hidden' name='password' value='" . $_POST["password"] . "'>
					<input type='submit' value='Редактировать/Создать вакансию'>
				</form></td>
		</tr>";
}
echo "</table>";
echo "<form action='Rec_form.php' method='POST'>
		<input type='hidden' name='id_Recruiter' value='" . $_POST["id_Recruiter"] . "'>
		<input type='hidden' name='password' value='" . $_POST["password"] . "'>
		<input type='submit' value='На страницу профайлинга'/>
	  </form>";
?>
