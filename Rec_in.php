<?php
echo "<div align='center'>";
	if(isset($_GET["Error"])){
		echo "<p>Неверные данные</p>";
	}
	echo"<p>Введите id и пароль</p>";
	echo "<form method ='POST' action='Rec_form.php'>";
		echo "<table><tr><th></th><th></th></tr>";
		echo "<tr><td>ID: </td><td><input name='id_Recruiter' type='text'></td></tr>";
		echo "<tr><td>Пароль: </td><td><input name='password' type='password'></td></tr>";
		echo "</table>";
		echo "<input type='submit' value='Войти'>";
	echo "</form>";
echo "</div>";
?>
