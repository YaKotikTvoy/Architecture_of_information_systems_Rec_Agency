<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Регистрация сотрудника</title>
	</head>
	<body>
		<?php
		if(isset($_GET["error_field"])){
			echo "<p align='center'>Заполните все поля</p>";
		}
		?>
		<form method="POST" action="Create_Employee.php" align="center">
			<p>Фамилия:		<input type="text" name="surname"/></p>
			<p>Имя:		<input type="text" name="name"/></p>
			<p>Отчество:		<input type="text" name="middlename"/></p>
			<p>Телефон:		<input type="text" name="phone"/></p>
			<p>email:		<input type="text" name="email"/></p>
			<p><input type="submit" value="Сохранить"/></p>
		</form>
	</body>
</html>
