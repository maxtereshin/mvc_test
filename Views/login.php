<h3>Страница авторизации</h3>
<p>
<form action="" method="post">
<table class="login">
	<tr>
		<th colspan="2">Авторизация</th>
	</tr>
	<tr>
		<td>Логин</td>
		<td><input type="text" name="login"></td>
	</tr>
	<tr>
		<td>Пароль</td>
		<td><input type="password" name="password"></td>
	</tr>
	<th colspan="2" style="text-align: right">
	<input type="submit" value="Войти" name="btn" style="width: 150px; height: 30px;"></th>
</table>
</form>
</p>

<?php
    if($login_status=="access_granted") {
        echo "<div class=\"alert alert-primary\" role=\"alert\">Авторизация прошла успешно.</div>";
    } elseif($login_status=="access_denied")  {
        echo "<div class=\"alert alert-danger\" role=\"alert\">Логин и/или пароль введены неверно.</div>";
    }
?>

