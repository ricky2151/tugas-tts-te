<!DOCTYPE html>
<html>
<head>
	<title>
		Read article
	</title>
</head>
<body>
	<a href='/addArticle'>Add Article</a>
<table>
	<thead>
		<th>Id</th>
		<th>Title</th>
		<th>Body</th>
	</thead>
	<tbody>
		@foreach ($articles as $row)
		<tr>
			<td>{{$row['id']}}</td>
			<td>{{$row['title']}}</td>
			<td>{{$row['body']}}</td>
			<td><a href='/editArticle/{{$row["id"]}}'>Edit</a></td>
			<td><a href='/deleteArticle/{{$row["id"]}}'>Delete</a></td>
		</tr>
		@endforeach
	</tbody>
</table>
</body>
</html>