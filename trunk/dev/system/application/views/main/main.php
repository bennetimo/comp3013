
<div>

<h3>Login</h3>

<form action="usermanager/login" method="POST">

	<input type="text" id="login_email" name="login_email"></input>
	<input type="password" id="login_password" name="login_password"></input>
	<input type="submit" value="login"></input>
	
</form>

<h3>Register</h3>

<form action="usermanager/register" method="POST">

	<table>
		<tr>
			<td>Full Name:</td>
			<td><input type="text" name="reg_full_name"></input></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input type="text" name="reg_email"></input></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input type="password" name="reg_password"></input></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="register"></input></td>
		</tr>
	</table>

</form>

<script type="text/javascript">
</script>

</div>
