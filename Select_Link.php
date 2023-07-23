<?php
$conn = new PDO("mysql:host=localhost;dbname=Recruitment_Agency", "root", "mypassword");
$sql = "SELECT * FROM Employer";
$stmt = $conn -> prepare($sql);
$stmt -> execute();
echo "<h1>Список работодателей</h1>";
echo "<table><tr><th>Фамилия</th><th>Имя</th><th>Отчество</th><th></th></tr>";
foreach($stmt as $row){
	echo "<tr>
			<td>" . $row["surname"] . "</td>
			<td>" . $row["name"] . "</td>
			<td>" . $row["middlename"] . "</td>
			<td>";
					$profession;
					$fd = fopen($row["surname"] . " " . $row["name"] . " " . $row["middlename"] . " Вакансия", "r");
					if(!$fd){
						$profession = "Вакансия не создана";
echo				$profession;
		 			}else{
		 				fgets($fd);
		 				fgets($fd);
		 				fgets($fd);
		 				$profession = fgets($fd);
		 				if($profession != null){//					<!--<input type='hidden' name='password' value='" . $row["password"] . "'>-->
echo "			<form action='Create_Link.php' method='POST'>
					<input type='hidden' name='id_Employer' value='" . $row["id_Employer"] . "'>
					<input type='hidden' name='surname' value='" . $row["surname"] . "'>
					<input type='hidden' name='name' value='" . $row["name"] . "'>
					<input type='hidden' name='middlename' value='" . $row["middlename"] . "'>
					<input type='hidden' name='phone' value='" . $row["phone"] . "'>
					<input type='hidden' name='email' value='" . $row["email"] . "'>

					<input type='hidden' name='profession' value='" . $profession . "'>
					<input type='hidden' name='id_Recruiter' value='" . $_POST["id_Recruiter"] . "'>
					<input type='hidden' name='password_rec' value='" . $_POST["password"] . "'>
					<input type='submit' value='Найти сотрудника'>
				</form>";
						}else{
echo "профессия пуста";
						}
						fclose($fd);
					}
echo"		</td>
		 </tr>";
}
echo "</table>";
echo "<form action='Rec_form.php' method='POST'>
		<input type='hidden' name='id_Recruiter' value='" . $_POST["id_Recruiter"] . "'>
		<input type='hidden' name='password' value='" . $_POST["password"] . "'>
		<input type='submit' value='На страницу профайлинга'>
	  </form>";
?>
