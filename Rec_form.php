<?php
if (isset($_POST["id_Recruiter"]) and isset($_POST["password"]) and !($_POST["id_Recruiter"] === null or $_POST["password"] === null)){
	$conn = new PDO("mysql:host=localhost;dbname=Recruitment_Agency", "root", "mypassword");
	$sql = "Select id_Recruiter, password FROM Recruiter WHERE id_Recruiter = :id_Recruiter and password = :password";
	$stmt = $conn -> prepare($sql);
	$stmt -> bindValue(":id_Recruiter", $_POST["id_Recruiter"], PDO::PARAM_INT);
	$stmt -> bindValue(":password", $_POST["password"], PDO::PARAM_STR);
	$stmt -> execute();
	if($stmt -> rowCount() > 0){
		echo "<div align='center'>
				<h1>Рекрутер " . $_POST["id_Recruiter"] . "</h1>
				<form method='POST' action='Select_Resume.php'>
					<input type='hidden' name='id_Recruiter' value='" . $_POST["id_Recruiter"] . "'>
					<input type='hidden' name='password' value='" . $_POST["password"] . "'>
					<input type='submit' value='Создание/Редактирование резюме'/>
				</form>

				<form method='POST' action='Select_Vacancy.php'>
					<input type='hidden' name='id_Recruiter' value='" . $_POST["id_Recruiter"] . "'>
					<input type='hidden' name='password' value='" . $_POST["password"] . "'>
					<input type='submit' value='Создание/Редактирование вакансии'/>
				</form>

				<form  method='POST' action='Select_Link.php'>
					<input type='hidden' name='id_Recruiter' value='" . $_POST["id_Recruiter"] . "'>
					<input type='hidden' name='password' value='" . $_POST["password"] . "'>
					<input type='submit' value='Связывание'/>
				</form>
				
				<form  method='POST' action='Delete_Users.php'>
					<input type='hidden' name='id_Recruiter' value='" . $_POST["id_Recruiter"] . "'>
					<input type='hidden' name='password' value='" . $_POST["password"] . "'>
					<input type='submit' value='Удаление пользователей'/>
				</form>
				
				<form  method='POST' action='Sign_in.php'>
					<input type='submit' value='Выйти'/>
				</form>
			  </div>";
	}else{
		//header("Location: Rec_in.php?Error=true&id_Recruiter=" . $_POST["id_Recruiter"] . "&password=" . $_POST["password"]);
		header("Location: Rec_in.php?Error=true");
	}
}else{
	//header("Location: Rec_in.php?Error=true&id_Recruiter=" . $_POST["id_Recruiter"] . "&password=" . $_POST["password"]);
	header("Location: Rec_in.php?Error=true");
}
?>
