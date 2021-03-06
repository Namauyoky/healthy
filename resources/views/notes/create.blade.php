@extends('app')

@section('main-content')
    <h1>
        Create a Note
    </h1>
    @include('partials/errors')
    <form method="post" action="{{url('notes')  }}" class="form">
        {!! csrf_field() !!}
        <div class="form-group">
        <textarea name="note" class="form-control" placeholder="Escribe tu nota...">{{ old('note') }}</textarea>
        </div>
            <br>
        <button type="submit" class="btn btn-primary">Create a note</button>
    </form>

@endsection


<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Title</title>
		<meta charset="UTF-8">
		<meta name=description content="">
		<meta name=viewport content="width=device-width, initial-scale=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" media="screen">
	</head>
	<body>
		<h1 class="text-center">Body}</h1>

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	</body>
</html>