<?php if(!isset($_SESSION['user_id'])) { ?>
<div align="center">
<form method="post">
<table>
	<tr>
		<td>Nom d'utilisateur : </td>
		<td><input type="text" name="login_username" /></td>
	</tr>
	<tr>
		<td><br></td>
	</tr>
	<tr>
		<td>Mot de passe : </td>
		<td><input type="password" name="login_password" /></td>
	</tr>
	<tr>
		<td><br></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" class="btn btn-success" name="login_submit" value="Je me connecte" /></td>
	</tr>
</table>
</form>
</div>
<?php } ?>