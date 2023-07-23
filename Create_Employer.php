<?php
echo $_POST["name"] . "<br>";
echo $_POST["surname"] . "<br>";
echo $_POST["middlename"] . "<br>";
echo $_POST["phone"] . "<br>";
echo $_POST["email"] . "<br>";
if(isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["middlename"])  && isset($_POST["phone"])  && isset($_POST["email"])){
	try{
		$conn = new PDO("mysql:host=localhost;dbname=Recruitment_Agency", "root", "mypassword");
		$sql = "INSERT INTO Employer(name, surname, middlename, phone, email) 
		values(:username, :usersurname, :usermiddlename, :userphone, :useremail)";
		$stmt = $conn -> prepare($sql);
		$stmt -> bindValue(":username", $_POST["name"], PDO::PARAM_STR);
		$stmt -> bindValue(":usersurname", $_POST["surname"], PDO::PARAM_STR);
		$stmt -> bindValue(":usermiddlename", $_POST["middlename"], PDO::PARAM_STR);
		$stmt -> bindValue(":userphone", $_POST["phone"], PDO::PARAM_INT);
		$stmt -> bindValue(":useremail", $_POST["email"], PDO::PARAM_STR);
		$stmt -> execute();
		
		$idsql = "Select id_Employer from Employer where name = :username and surname = :usersurname and middlename = :usermiddlename and phone = :userphone and email = :useremail";
		$stmt = $conn -> prepare($idsql);
		$stmt -> bindValue(":username", $_POST["name"], PDO::PARAM_STR);
		$stmt -> bindValue(":usersurname", $_POST["surname"], PDO::PARAM_STR);
		$stmt -> bindValue(":usermiddlename", $_POST["middlename"], PDO::PARAM_STR);
		$stmt -> bindValue(":userphone", $_POST["phone"], PDO::PARAM_INT);
		$stmt -> bindValue(":useremail", $_POST["email"], PDO::PARAM_STR);
		$stmt -> execute();
		if($stmt -> rowCount() > 0){
			foreach($stmt as $row){
				echo "Пользователь успешно зарегистрирован. <br>Его id_Employer: <h1>" . $row["id_Employer"] . "</h1>";
			}
		}
		$conn = null;
	}catch(PDOException $ex){
		echo $ex -> getMessage() . "<br>";
	}
}else{
	header("Location: Create_password_form_Employer.php?invalid_password=true");
}
echo "<form action='Sign_in.php'><input type='submit' value='На страницу входа'></form>";
?>
