<?php

$profession;
$work_schedule;
$education;
$salary;
$comment;

$surname;
$name;
$middlename;

$id_Recruiter;
$password;
//Когда открываем вакансию
if(isset($_POST["surname"]) && isset($_POST["name"]) && isset($_POST["middlename"])){
	$surname = $_POST["surname"];
	$name = $_POST["name"];
	$middlename = $_POST["middlename"];
	
	$id_Recruiter = $_POST["id_Recruiter"];
	$password = $_POST["password"];
	try{
		$fd = fopen($_POST["surname"] . " " . $_POST["name"] . " " . $_POST["middlename"] . " Вакансия", 'r');
		if(!$fd){//Если файл не открывается, значит его нет,
			$fd = fopen($_POST["surname"] . " " . $_POST["name"] . " " . $_POST["middlename"] . " Вакансия", 'w');//необходимо его создать
			fclose($fd);
		}else{//Если он есть, то прочитать и проинициализировать переменные, нужные для заполнения открываемой вакансии
			$surname = $_POST["surname"];
			fgets($fd);
			$name = $_POST["name"];
			fgets($fd);
			$middlename = $_POST["middlename"];
			fgets($fd);
			$profession = fgets($fd);
			$work_schedule = fgets($fd);
			$education = fgets($fd);
			$salary = fgets($fd);
			while(!feof($fd)){
				$comment .= fgets($fd); 
			}
			fclose($fd);
		}
	}catch(Throwable $ex){
		echo $ex -> getMessage . "<br>";
	}
}
//Когда после редактирования сохраняем вакансию
if(isset($_POST["formsurname"]) && isset($_POST["formname"]) && isset($_POST["formmiddlename"]) && isset($_POST["profession"]) && isset($_POST["work_schedule"]) && isset($_POST["education"]) && isset($_POST["salary"]) && isset($_POST["comment"])){
	$surname = $_POST["formsurname"];
	$name = $_POST["formname"];
	$middlename = $_POST["formmiddlename"];
	$profession = $_POST["profession"];
	$work_schedule = $_POST["work_schedule"];
	$education = $_POST["education"];
	$salary = $_POST["salary"];
	$comment = $_POST["comment"];
	
	$id_Recruiter = $_POST["id_Recruiter"];
	$password = $_POST["password"];
	//Перезаписываем данные в файл
	$fd = fopen($_POST["formsurname"] . " " . $_POST["formname"] . " " . $_POST["formmiddlename"] . " Вакансия", 'w');
	fwrite($fd, $surname);
	fwrite($fd, "\n" . $name);
	fwrite($fd, "\n" . $middlename);
	fwrite($fd, "\n" . $profession);
	fwrite($fd, "\n" . $work_schedule);
	fwrite($fd, "\n" . $education);
	fwrite($fd, "\n" . $salary);
	fwrite($fd, "\n" . $comment);
	fclose($fd);
}


//Заполнение формы вакансии переменными, перечисленными в самом начале
echo "<form method='POST' action='Create_Vacancy.php'>
		<input type='hidden' name='formsurname' value='" . $surname . "'>
		<input type='hidden' name='formname' value='" . $name . "'>
		<input type='hidden' name='formmiddlename' value='" . $middlename . "'>
		
		<input type='hidden' name='id_Recruiter' value='" . $id_Recruiter . "'>
		<input type='hidden' name='password' value='" . $password . "'>
		<h1>Вакансия</h1>
		<p>Работодатель " . $surname ." " . $name . " " . $middlename . "</p>
		<table>
			<tr><th></th><th></th></tr>
			<tr><td>Требуемая должность</td><td>
			<select name='profession'>";
			$conn = new PDO("mysql:host=localhost;dbname=Recruitment_Agency", "root", "mypassword");
			$sql = "SELECT profession FROM Prof_list";
			$stmt = $conn -> prepare($sql);
			$stmt -> execute();
			foreach($stmt as $row){//Список профессий 
				if($row["profession"] == "Профессии сервиса" or $row["profession"] == "Экономика" or $row["profession"] == "IoT" or $row["profession"] == "Медицина" or $row["profession"] == "Транспорт" or $row["profession"] == "Преподавание" or $row["profession"] == "Техническая сфера" or $row["profession"] == "Правоохранительные органы" or $row["profession"] == "Сельское хозяйство"){
					echo "<option value='" . $row["profession"] . "' disabled>" . $row["profession"] ."</option>";
				}elseif($row["profession"] == trim($profession)){
					echo "<option value='" . $row["profession"] . "' selected>" . $row["profession"] . "</option>";
				}else{
					echo "<option value='" . $row["profession"] . "'>" . $row["profession"] . "</option>";
				}
			}
echo "			</select>
			</td></tr>
			<tr><td>График работы</td><td><select name='work_schedule'>";//Типы графиков работ
			$conn = new PDO("mysql:host=localhost;dbname=Recruitment_Agency", "root", "mypassword");
			$sql = "SELECT work_schedule FROM Work_schedule";
			$stmt = $conn -> prepare($sql);
			$stmt -> execute();
			foreach($stmt as $row){
				if($row["work_schedule"] == trim($work_schedule)){
					echo "<option value='" . $row["work_schedule"] . "' selected>" . $row["work_schedule"] . "</option>";
				}else{
					echo "<option value='" . $row["work_schedule"] . "'>" . $row["work_schedule"] . "</option>";
				}
			}
echo "		</td></tr>
			<tr><td>Образование</td><td><select name='education'>";//Образование
			$conn = new PDO("mysql:host=localhost;dbname=Recruitment_Agency", "root", "mypassword");
			$sql = "SELECT education FROM Education";
			$stmt = $conn -> prepare($sql);
			$stmt -> execute();
			foreach($stmt as $row){
				if(trim($row["education"]) == trim($education)){
					echo "<option value='" . $row["education"] . "' selected>" . $row["education"] . "</option>";
				}else{
					echo "<option value='" . $row["education"] . "'>" . $row["education"] . "</option>";
				}
			}
echo "		</td></tr>
			<tr><td>Оклад</td><td><input type='text' name='salary' value='" . $salary . "'/></td></tr>
		</table>
		<p>Комментарий по поводу работы</p>
		<textarea name='comment'>" . $comment . "</textarea>
		<p><input type='submit' value='Сохранить'></p>
	  </form>";
echo "<form action='Select_Vacancy.php' method='POST'>
		<input type='hidden' name='id_Recruiter' value='" . $id_Recruiter . "'>
		<input type='hidden' name='password' value='" . $password . "'>
		<input type='submit' value='На окно выбора вакансии'/>
	  </form>";
echo "<form action='Rec_form.php' method='POST'>
		<input type='hidden' name='id_Recruiter' value='" . $id_Recruiter . "'>
		<input type='hidden' name='password' value='" . $password . "'>
		<input type='submit' value='На страницу профайлинга'/>
	  </form>";
?>
