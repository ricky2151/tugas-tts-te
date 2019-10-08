<!DOCTYPE html>
<html>
<head>
	<title>
		Add Article
	</title>
</head>
<body>
	
	@if(isset($data["article"]))
	<form action='/submitArticle'>
		<input type='hidden' name='idarticle' value='{{$data["article"]->id}}'>
		<label>title : </label><input type='text' name='title' value='{{$data["article"]->title}}'/>
		<label>body : </label><input type='text' name='title' value='{{$data["article"]->body}}'/>
		<label>Category : </label>
		@foreach($data["category"] as $row)
			<?php
				$valueforinput = false;
			?>
			@foreach($data["article_category"] as $val)
				<?php
					if($val['id'] == $row['id'])
					{
						
						$valueforinput = true;
						break;
					}
				?>	
			@endforeach
			<?php

			?>
		 	<input type="checkbox" name="category[{{$row['id']}}]" value="{{$row['name']}}" @if($valueforinput) checked @endif>{{$row['name']}}
		 @endforeach
		 <input type="submit" value="Submit">
	</form>
	@else
	<form action='/submitArticle'>
		<label>title : </label><input type='text' name='title'/>
		<label>body : </label><input type='text' name='title'/>
		<label>Category : </label>
		@foreach($category as $row)
		 <input type="checkbox" name="category[{{$row['id']}}]" value="{{$row['name']}}">{{$row['name']}}
		 @endforeach
		 <input type="submit" value="Submit">
	</form>
	@endif
</body>
</html>