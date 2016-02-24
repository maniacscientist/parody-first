<form method="post" name="connectionInfo" id="connectionInfo" action="">
<table align="center">
	<tr>
		<td colspan="2">
			Enter MySQL connection info
		</td>
	</tr>
	<tr>
		<td><label for="server">server</label></td>
		<td><input name="server" id="server"/></td>
	</tr>
	<tr>
		<td><label for="user">user</label></td>
		<td><input name="user" id="user"/></td>
	</tr>
	<tr>
		<td><label for="password">password</label></td>
		<td><input name="password" id="password"/></td>
	</tr>
	<tr>
		<td><label for="dbname">dbname</label></td>
		<td><input name="dbname" id="dbname"/></td>
	</tr>
	<tr>
		<td colspan="2"><input type="button" onclick="submitConnectionInfo()" value="Create" /></td>
	</tr>
</table>
</form>
