<?php
$profession;
$surname;
$name;
$middlename;
$age;
$education;
$salary;
$comment;
$file;

$id_Recruiter;
$password;
if(isset($_POST["surname"]) && isset($_POST["name"]) && isset($_POST["middlename"])){
	try{
		$file = $_POST["surname"] . " " . $_POST["name"] . " " . $_POST["middlename"] . " Резюме";
		$fd = fopen($file, 'r');
		if(!$fd){
			$fd = fopen($file, 'w');
			$surname = $_POST["surname"];
			$name = $_POST["name"];
			$middlename = $_POST["middlename"];
			fclose($fd);
		}else{
			$profession = fgets($fd);
			$surname = $_POST["surname"];
			fgets($fd);
			$name = $_POST["name"];
			fgets($fd);
			$middlename = $_POST["middlename"];
			fgets($fd);
			$age = fgets($fd);
			$education = fgets($fd);
			$salary = fgets($fd);
			while(!feof($fd)){
				$comment .= fgets($fd);
			}
			fclose($fd);
		}
	}catch(Throwable $ex){
		echo $ex -> getMessage() . "<br>";
	}
	$id_Recruiter = $_POST["id_Recruiter"];
	$password = $_POST["password"];
}
if(isset($_POST["formsurname"]) && isset($_POST["formname"]) && isset($_POST["formmiddlename"]) && isset($_POST["age"]) && isset($_POST["education"]) && isset($_POST["profession"]) && isset($_POST["salary"]) && isset($_POST["comment"])){
	$file = $_POST["formsurname"] . " " . $_POST["formname"] . " " . $_POST["formmiddlename"] . " Резюме";
	$profession = $_POST["profession"];
	$surname = $_POST["formsurname"];
	$name = $_POST["formname"];
	$middlename = $_POST["formmiddlename"];
	$age = $_POST["age"];
	$education = $_POST["education"];
	$salary = $_POST["salary"];
	$comment = $_POST["comment"];
	$fd = fopen($file, 'w');
	fwrite($fd, $profession);
	fwrite($fd, "\n" . $surname);
	fwrite($fd, "\n" . $name);
	fwrite($fd, "\n" . $middlename);
	fwrite($fd, "\n" . $age);
	fwrite($fd, "\n" . $education);
	fwrite($fd, "\n" . $salary);
	fwrite($fd, "\n" . $comment);
	fclose($fd);
	$id_Recruiter = $_POST["id_Recruiter"];
	$password = $_POST["password"];
}
echo "<form action='Create_Resume.php' method='POST'>
			<h1>Резюме</h1>
			<table>
			<tr><th></th><th></th></tr>
					<tr><td>Фамилия:</td><td><input type='text' name='formsurname' value='" . $surname . "'/></td></tr>
					<tr><td>Имя:</td><td><input type='text' name='formname' value='" . $name . "'/></td></tr>
					<tr><td>Отчество:</td><td><input type='text' name='formmiddlename' value='" . $middlename . "'/></td></tr>
					<tr><td>Количество лет:</td><td><input type='text' name='age' value='" . $age . "'/></td></tr>
					<tr><td>Образование</td><td><input type='text' name='education' value='" . $education . "'/></td></tr>
					<tr><td>Желаемая профессия</td><td><input type='text' name='profession' value='" . $profession . "'/></td></tr>
					<tr><td>Желаемый оклад</td><td><input type='text' name='salary' value='" . $salary . "'/></td></tr>
			</table>
			<p>Характеристика</p>
			<p><textarea name='comment'>" . $comment . "</textarea></p>
			<p><input type='submit' value='Сохранить'/></p>
			<input type='hidden' name='id_Recruiter' value='" . $_POST["id_Recruiter"] . "'>
			<input type='hidden' name='password' value='" . $_POST["password"] . "'>
		  </form>";
echo "<form action='Select_Resume.php' method='POST'>
		<input type='hidden' name='id_Recruiter' value='" . $id_Recruiter . "'>
		<input type='hidden' name='password' value='" . $password . "'>
		<input type='submit' value='На окно выбора резюме'/>
	  </form>";
echo "<form action='Rec_form.php' method='POST'>
		<input type='hidden' name='id_Recruiter' value='" . $id_Recruiter . "'>
		<input type='hidden' name='password' value='" . $password . "'>
		<input type='submit' value='На страницу профайлинга'/>
	  </form>";
?>
