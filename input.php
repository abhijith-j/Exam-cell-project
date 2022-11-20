<html>
<head>
	<title>PROJECT</title>
</head>	

<body>
<form autocomplete="off" method="POST">
	<h1>EMPLOYEE DETAILS</h1>
	<label for=name>NAME&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
	<input type="text" name="textbox1"><br>
	<br>
	<label for=id>EMPLOYEE ID</label>
	<input type="text" name="textbox2"><br>
		<br>
	<label for=dept>DEPARTMENT</label>
	<input type="text" name="textbox3"><br>
		<br>
	<label for=desig>DESIGNATION</label>
	<select name="textbox4">
    	<option value="HOD">HOD</option>
    	<option value="PROFESSOR">PROFESSOR</option>
   	 	<option value="ASSOCIATE">ASSOCIATE</option>
    	<option value="ASSISTANT">ASSISTANT</option>
  	</select>
		<br>
	<input type="submit" formaction="inputtuple.php" value= "SUBMIT"><br><br><br>
</form>
<form action="fileimp.php" method="POST" enctype="multipart/form-data">
	<input type="file" name="file_name"/>
	<button type="submit" name="sub">IMPORT</button>
</form><br><br>
<form>
	<button type="submit" formaction="delete.html">Delete</button>
</form>
<form>
	<button type="submit" formaction="admin.html">BACK</button>
</form>
</body>
</html>
