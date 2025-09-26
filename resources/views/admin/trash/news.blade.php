<!DOCTYPE html>
<html>
<head>
	<title>view news</title>
</head>
<body>
	<h1>{{ $pageName }}</h1>
    <a href="/admin/news/create">Add create</a>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Email</th>
            <th>Tools</th>
        </tr>
    </thead>
    <tbody>
    	@foreach ($news as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td><a href="/admin/news/{{ $row->id }}">{{ $row->title }}</a></td>
            <td>{{ $row->email }}</td>
            <td>
                <a href="/admin/news/edit/{{ $row->id }}">Edit</a>
                <br>
                <form method="post" action="/admin/news/delete/{{ $row->id }}" onsubmit="return ConfirmDelete( this )">
                    @method('DELETE')
                    @csrf
                    <button>Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>