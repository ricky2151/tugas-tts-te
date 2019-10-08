<!DOCTYPE html>
<html>
<head>
	<title>
		Add Article
	</title>
</head>
<body>
	@if(isset($category))

	<form action='/submitCategory' method='POST'>
		<input type='hidden' name='idcategory' value='{{$category->id}}'>
		<label>name : </label><input type='text' name='name' value='{{$category->name}}'/>
		 <input type="submit" value="Submit">
	</form>
	@else
	<form action='/submitCategory'>
			<label>name : </label><input type='text' name='name'/>
			 <input type="submit" value="Submit">
		</form>
	@endif
</body>
</html>