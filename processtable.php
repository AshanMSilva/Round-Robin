
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="post" action="processinputs.php">
		Time: <input type="number" name="time">
		<table>
			<th>Process Name</th>
			<th>Process Colour</th>
			<th>Burst Time</th>
			<th>Arrival Time</th>
			</tr>
			<tr>
					<td><input type="text" name="p[]" value="P1" ></td>
					<td><input style="background-color: red;" type="text" name="c[]" value="Red" ></td>
					<td><input type="number" name="b[]" id=""></td>
					<td><input type="number" name="a[]" id=""></td>
					
			</tr>
			<tr>
				<td><input type="text" name="p[]" value="P2"></td>
				<td><input style="background-color: yellow;" type="text" name="c[]" value="Yellow" ></td>
				<td><input type="number" name="b[]" id=""></td>
				<td><input type="number" name="a[]" id=""></td>
			</tr>
			<tr>
				<td><input type="text" name="p[]" value="P3"></td>
				<td><input style="background-color: blue;" type="text" name="c[]" value="Blue" ></td>
				<td><input type="number" name="b[]" id=""></td>
				<td><input type="number" name="a[]" id=""></td>
			</tr>
			<tr>
				<td><input type="text" name="p[]" value="P4"></td>
				<td><input style="background-color: green;" type="text" name="c[]" value="Green" ></td>
				<td><input type="number" name="b[]" id=""></td>
				<td><input type="number" name="a[]" id=""></td>
			</tr>
			<tr>
				<td><input type="text" name="p[]" value="P5"></td>
				<td><input style="background-color: orange;" type="text" name="c[]" value="Orange" ></td>
				<td><input type="number" name="b[]" id=""></td>
				<td><input type="number" name="a[]" id=""></td>
			</tr>
			<tr>
				<td><input type="submit" value="Submit" name="submit"></td>
			</tr>
		
		</table>
		
		</form>

</body>
</html>