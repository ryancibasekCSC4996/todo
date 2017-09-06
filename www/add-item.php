<html>
	<head>
		<title>
			Add Item
		</title>
	</head>
	<body>
		<form action="/post.php" method = "post">
			Task: <input type = "text" name = "Task" value = "Task" maxlength = "255"><br>
			Description: <input type = "text" name = "Description" value = "Describe task here." maxlength = "1000"><br>
			Priority:
			<select name="Priority" id="">
				<<option value="Low">Low</option>
				<<option value="Normal">Normal</option>
				<<option value="High">High</option>
			</select>
			<input type="submit" value="Submit">
		</form>
	</body>
</html>
