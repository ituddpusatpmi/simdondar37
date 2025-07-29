<HTML>
<HEAD>
<TITLE>scrollable table body</TITLE>
</HEAD>

<BODY>
	<table align="center" width="80%" height=100 border="1" cellpadding="0" cellspacing="0">
		<thead>
			<tr align="center" height="15">
				<th width="60%">Name</th>
				<th width="40%">Category</th>
			</tr>
		</thead>
		<tbody style="overflow:auto; height:100; margin:0% 10%;">
			<tr height="10"><td width="60%">PC</td><td width="40%">Computer</td></tr>
			<tr height="10"><td width="60%">Unix Station</td><td width="40%">Computer</td></tr>
			<tr height="10"><td width="60%">Dart</td><td width="40%">Computer</td></tr>

			<tr height="10"><td width="60%">Monitor</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">X Screen</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">Fan</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">Documentation</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">Streamer</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">PC</td><td width="40%">Computer</td></tr>
			<tr height="10"><td width="60%">Unix Station</td><td width="40%">Computer</td></tr>
			<tr height="10"><td width="60%">Dart</td><td width="40%">Computer</td></tr>

			<tr height="10"><td width="60%">Monitor</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">X Screen</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">Fan</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">Documentation</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">Streamer</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">PC</td><td width="40%">Computer</td></tr>
			<tr height="10"><td width="60%">Unix Station</td><td width="40%">Computer</td></tr>
			<tr height="10"><td width="60%">Dart</td><td width="40%">Computer</td></tr>

			<tr height="10"><td width="60%">Monitor</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">X Screen</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">Fan</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">Documentation</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">Streamer</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">PC</td><td width="40%">Computer</td></tr>
			<tr height="10"><td width="60%">Unix Station</td><td width="40%">Computer</td></tr>
			<tr height="10"><td width="60%">Dart</td><td width="40%">Computer</td></tr>

			<tr height="10"><td width="60%">Monitor</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">X Screen</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">Fan</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">Documentation</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">Streamer</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">PC</td><td width="40%">Computer</td></tr>
			<tr height="10"><td width="60%">Unix Station</td><td width="40%">Computer</td></tr>
			<tr height="10"><td width="60%">Dart</td><td width="40%">Computer</td></tr>

			<tr height="10"><td width="60%">Monitor</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">X Screen</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">Fan</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">Documentation</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">Streamer</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">PC</td><td width="40%">Computer</td></tr>
			<tr height="10"><td width="60%">Unix Station</td><td width="40%">Computer</td></tr>
			<tr height="10"><td width="60%">Dart</td><td width="40%">Computer</td></tr>

			<tr height="10"><td width="60%">Monitor</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">X Screen</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">Fan</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">Documentation</td><td width="40%">Other</td></tr>
			<tr height="10"><td width="60%">Streamer</td><td width="40%">Other</td></tr>
		</tbody>
	<tfoot>
		<form name="addEltType" method="post" action="add.php?action=add" onSubmit="return checkForm(this);">
			<tr>
				<th width="60%"><input name="name_eltType" type="text" maxlength="30" size="30" value=""></th>
				<th width="40%">
					<select class="liste" name="name_eltCat_eltType" value="name_eltCat_eltType" onChange=addEltCat(this)>
						<option value="Computer">Computer</option>
						<option value="Other"selected>Other</option>
						<option value="&lt;new&gt;">&lt;new&gt;</option>
					</select>
				</th>
			</tr>
		</form>
	</tfoot>
</table>

<table align="right">
	<tr>
		<td><input type="submit" name="addEltType" value="Add"></td>
		<td><input type="reset" value="Reset"></td>
		<td><input type="submit" name="Cancel" value="Cancel" onClick="return cancel();"></td>
		<td width="100">&nbsp;</td>
	</tr>
</table>
</BODY>
</HTML>
