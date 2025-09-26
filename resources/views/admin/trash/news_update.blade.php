<!DOCTYPE html>
<html>
<head>
	<title>Update news</title>
</head>
<body>
<h1>{{ $pageName }}</h1>
<form method="post" action="/admin/news/update/{{ $news->id }}">
	@method('PATCH')
	@csrf
	<input type="hidden" name="id" value="{{ $news->id }}">
	<p>
		<label for="title">Title</label>
		<input type="text" name="title" value="{{ $news->title }}">
	</p>

	<p>
		<label for="email">Email</label>
		<input type="email" name="email" value="{{ $news->email }}">
	</p>

	<p>
		<label for="description">Description</label>
		<textarea rows="5" cols="50" name="description">{{ $news->description }}</textarea>
	</p>

	<p>
		<button type="submit">Submit</button>
	</p>
</form>
</body>
</html>