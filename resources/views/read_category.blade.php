<!DOCTYPE html>
<html>
<head>
	<title>
		Read Category
	</title>
</head>
<body>
	<a href='/addCategory'>Add Category</a>
<table>
	<thead>
		<th>Id</th>
		<th>Name</th>
	</thead>
	<tbody>
		@foreach ($categories as $row)
		<tr>
			<td>{{$row['id']}}</td>
			<td>{{$row['name']}}</td>
			<td><a href='/editCategory/{{$row["id"]}}'>Edit</a></td>
			<td><a href='/deleteCategory/{{$row["id"]}}'>Delete</a></td>
		</tr>
		@endforeach
	</tbody>
</table>
</body>
</html>