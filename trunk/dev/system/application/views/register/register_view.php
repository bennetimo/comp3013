
<div class="content_box">

	<p>So you would like to get started with a Musique account? No problem!</p>
	<p>Just fill out your details below and you can be using our service within minutes.</p>

	<form id="reg_form" action="<?=site_url('usermanager/register')?>" method="POST">
	
		<table>
			<tr>
				<td>First Name:</td>
				<td><input type="text" name="reg_first_name"></input></td>
			</tr>
			<tr>
				<td>last Name:</td>
				<td><input type="text" name="reg_last_name"></input></td>
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
				<td><input type="submit" class="normal_button" value="register"></input></td>
			</tr>
			<tr>
				<td colspan="2"><div id="reg_error" style="display: none;"></div></td>
			</tr>
		</table>
		
		<p>Note. Please remember to use a real email address, as we will send an activation request to it!</p>
	
	</form>
</div>

<script>

var registerForm = $("#reg_form");
var registerError = $("#reg_error");

registerForm.submit(function() {

	var submit = false;
	
	$.ajax({
		url: 'usermanager/validate_register_form',
		async: false,
		type: 'POST',
		dataType: 'json',
		data: registerForm.serialize(),
		
		success: function(data) {
		
			if (data['error']) {
				registerError.show();
				registerError.html(data.error);
			}
			else {
				registerError.hide();
				registerError.html("");
				submit = true;
			}
		}
	});
	
	return submit;
});

</script>