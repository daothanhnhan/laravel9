<!DOCTYPE html>
<html>
<head>
	<title>news detail</title>
</head>
<body>
<h1>News</h1>
<h2>{{ $news->title }}</h2>
<p>{{ $news->email }}</p>
<div>{{!! $des !!}}</div>
<a href="/admin/news">list news</a>
</body>
</html>