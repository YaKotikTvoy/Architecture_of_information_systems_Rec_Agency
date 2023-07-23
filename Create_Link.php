<?php
function Create_document_with_pretendent(string $name_file, string $mode, array $id_Employees, int $id_Employer, string $surname, string $name, string $middlename, string $phone, string $email, string $prof){
	/*$conn = new PDO("mysql:host=localhost;dbname=Recruitment_Agency","root","mypassword");
	$sql = "SELECT name, surname, phone, email middlename FROM Employer WHERE id_Employer = :id_Employer";
	$stmt = $conn -> prepare($sql);
	$stmt -> bindValue(":id_Employer", $id_Employer, PDO::PARAM_INT);
	$stmt -> execute();
	foreach($stmt as $row){
		$Employer_name = $row["name"];
		$Employer_surname = $row["surname"];
		$Employer_middlename = $row["phone"];
		$Employer_email = $row["email"];
	}*/
	$conn = new PDO("mysql:host=localhost;dbname=Recruitment_Agency","root","mypassword");
	$fd = fopen($name_file, $mode);
	/*$Employer_name = $name;
	$Employer_surname = $surname;
	$Employer_middlename = $middlename;
	$Employer_phone = $phone;
	$Employer_email = $email;*/
	fwrite($fd, "Вакансия работодателя: $surname $name $middlename. Требуемая профессия: $prof.");
	fwrite($fd, "\n" . "Контактные данные работодателя:");
	fwrite($fd, "\n" . "ФИО: $surname $name $middlename");
	fwrite($fd, "\n" . "Телефон: $phone");
	fwrite($fd, "\n" . "Email: $email");
	fwrite($fd, "\n\n\nПретенденты на должность:\n\n\n");
	foreach($id_Employees as $row){
		$conn = new PDO("mysql:host=localhost;dbname=Recruitment_Agency","root","mypassword");
		$sql = "SELECT * FROM Employee WHERE id_Employee = :id_Employee";
		$stmt = $conn -> prepare($sql);
		$stmt -> bindValue(":id_Employee", $row, PDO::PARAM_INT);
		$stmt -> execute();
		foreach($stmt as $row2){
			$Employee_surname = $row2["surname"];
			$Employee_name = $row2["name"];
			$Employee_middlename = $row2["middlename"];
			$Employee_phone = $row2["phone"];
			$Employee_email = $row2["email"];
			$fd2 = fopen($row2["surname"] . " " . $row2["name"] . " " . $row2["middlename"] . " Резюме", 'r');
			$profession = fgets($fd2);
			fgets($fd2);
			fgets($fd2);
			fgets($fd2);
			$age = fgets($fd2);
			$education = fgets($fd2);
			$salary = fgets($fd2);
			$comment;
			while(!feof($fd2)){
				$comment .= fgets($fd2);
			}
			fclose($fd2);
			fwrite($fd, "id: $row. Претендент: $Employee_surname $Employee_name $Employee_middlename .");
			fwrite($fd, "\nВозраст: $age.");
			fwrite($fd, "\nОбразование: $education.");
			fwrite($fd, "\nЖелаемый оклад : $salary.");
			fwrite($fd, "\nХарактеристика сотрудника:\n$comment");
			fwrite($fd, "\nКонтактыне данные:");
			fwrite($fd, "\nТелефон: $Employee_phone");
			fwrite($fd, "\nEmail: $Employee_email");
		}
		fwrite($fd, "\n\n");
	}
	fclose($fd);
}
$id_Employer;
$surname;
$name;
$middlename;
$phone;
$email;
//$password;
$prof;

$id_Recruiter;
$password_rec;
if(isset($_POST["formid_Employer"]) && isset($_POST["formsurname"]) && isset($_POST["formname"]) && isset($_POST["formmiddlename"]) && isset($_POST["formphone"]) && isset($_POST["formemail"]) /*&& isset($_POST["formpassword"])*/ && isset($_POST["formprofession"]) && isset($_POST["formid_Recruiter"])){
	$id_Employer = $_POST["formid_Employer"];
	$surname = $_POST["formsurname"];
	$name = $_POST["formname"];
	$middlename = $_POST["formmiddlename"];
	$phone = $_POST["formphone"];
	$email = $_POST["formemail"];
	//$password = $_POST["formpassword"];
	$prof = $_POST["formprofession"];
	$id_Recruiter = $_POST["formid_Recruiter"];
	$password_rec = $_POST["password_rec"];
	
	$conn = new PDO("mysql:host=localhost;dbname=Recruitment_Agency", "root", "mypassword");
	$sql = "DELETE FROM Link WHERE id_Employer = :id_Employer";
	$stmt = $conn -> prepare($sql);
	$stmt -> bindValue(":id_Employer", $_POST["formid_Employer"], PDO::PARAM_INT);
	$stmt -> execute();
	$conn = null;
	foreach($_POST["id_Employees"] as $Employee){
		$conn = new PDO("mysql:host=localhost;dbname=Recruitment_Agency", "root", "mypassword");
		$sql = "INSERT INTO Link (id_Employer, id_Employee, id_Recruiter) VALUES( :id_Employer, :id_Employee, :id_Recruiter)";
		$stmt = $conn -> prepare($sql);
		$stmt -> bindValue(":id_Employer", $_POST["formid_Employer"], PDO::PARAM_INT);
		$stmt -> bindValue(":id_Employee", $Employee, PDO::PARAM_INT);
		$stmt -> bindValue(":id_Recruiter", $_POST["formid_Recruiter"], PDO::PARAM_INT);
		$stmt -> execute();
		$conn = null;
	}
}
if(isset($_POST["surname"]) && isset($_POST["name"]) && isset($_POST["middlename"])){
	$id_Employer = $_POST["id_Employer"];
	$surname = $_POST["surname"];
	$name = $_POST["name"];
	$middlename = $_POST["middlename"];
	$phone = $_POST["phone"];
	$email = $_POST["email"];
	//$password = $_POST["password"];
	$prof = $_POST["profession"];
	$id_Recruiter = $_POST["id_Recruiter"];
	$password_rec = $_POST["password_rec"];
}

$conn = new PDO("mysql:host=localhost;dbname=Recruitment_Agency", "root", "mypassword");
$sql = "SELECT * FROM Employee";
$stmt = $conn -> prepare($sql);
$stmt -> execute();
echo "<p>Вакансия: " . $surname . " " . $name . " " . $middlename . ".</p> 
	Требуемая профессия: <strong>" . $prof . "</strong><br><br>";

echo "Список сотрудников";
echo "<form action='Create_Link.php' method='POST'>
		<table>
			<tr><th>Фамилия</th><th>Имя</th><th>Отчество</th><th>Желаемая профессия</th><th>Связать</th></tr>";
			foreach($stmt as $row){
				$fd = fopen($row["surname"] . " " . $row["name"] . " " . $row["middlename"] . " Резюме", 'r');
				if(!$fd){
					//fclose($fd); Нельзя закрывать файл, который не открыт
					$profession = 'пустое поле';
					echo "<tr>";
					echo "<td>" . $row["surname"] ."</td>
						  <td>" . $row["name"] . "</td>
						  <td>" . $row["middlename"] . "</td>
						  <td>" . $profession . "</td>
						  <td>создайте резюме</td>";
				echo "</tr>";
				}else{
					$profession = fgets($fd);
					fclose($fd);
					echo "<tr>";
							echo "<td>" . $row["surname"] ."</td>
								  <td>" . $row["name"] . "</td>
								  <td>" . $row["middlename"] . "</td>";
					if($profession == null){
							echo "<td>пустое поле</td>
								  <td>профессии</td>";
					}else{
							echo "<td><b>" . $profession . "</b></td>";
							$conn = new PDO("mysql:host=localhost;dbname=Recruitment_Agency", "root", "mypassword");
							$sql = "SELECT * FROM Link WHERE id_Employer = :id_Employer and id_Employee = :id_Employee";
							$stmt = $conn -> prepare($sql);
							$stmt -> bindValue(":id_Employer", $id_Employer, PDO::PARAM_INT);
							$stmt -> bindValue(":id_Employee", $row["id_Employee"], PDO::PARAM_INT);
							$stmt -> execute();
							if($stmt -> rowCount() > 0){
								echo "<td><input type='checkbox' name='id_Employees[]' value='" . $row["id_Employee"] . "' checked></td>";
							}else{
								echo "<td><input type='checkbox' name='id_Employees[]' value='" . $row["id_Employee"] . "'></td>";
							}
					}
					echo "</tr>";
				}
			}//		<input type='hidden' name='formpassword' value='" . $password . "'>
echo "</table>
		<input type='hidden' name='formid_Recruiter' value='" . $id_Recruiter . "'>
		<input type='hidden' name='formid_Employer' value='" . $id_Employer . "'>
		<input type='hidden' name='formsurname' value='" . $surname . "'>
		<input type='hidden' name='formname' value='" . $name . "'>
		<input type='hidden' name='formmiddlename' value='" . $middlename . "'>
		<input type='hidden' name='formphone' value='" . $phone . "'>
		<input type='hidden' name='formemail' value='" . $email . "'>

		<input type='hidden' name='formprofession' value='" . $prof . "'>
		<input type='hidden' name='id_Recruiter' value='" . $id_Recruiter . "'>
		<input type='hidden' name='password_rec' value='" . $password_rec . "'>
		<input type='hidden' name='Save' value='" . true . "'>
		<p><input type='submit' value='Сохранить'></p>
	</form>";
if(isset($_POST["Save"])){
	Create_document_with_pretendent($surname . " " . $name . " " . $middlename . " Претенденты на вакансию $prof", 'w', $_POST["id_Employees"], $id_Employer, $surname, $name, $middlename, $phone, $email, $prof);
}
echo "<form action='Select_Link.php' method='POST'>
		<input type='hidden' name='id_Recruiter' value='" . $id_Recruiter . "'>
		<input type='hidden' name='password' value='" . $password_rec . "'>
		<input type='submit' value='На окно выбора связки'/>
	  </form>";
echo "<form action='Rec_form.php' method='POST'>
		<input type='hidden' name='id_Recruiter' value='" . $id_Recruiter . "'>
		<input type='hidden' name='password' value='" . $password_rec . "'>
		<input type='submit' value='На страницу профайлинга'/>
	  </form>";
?>
