<!DOCTYPE html>
<html lang="en">

<head>
    <title>users</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <h2>edit</h2>
        <form action="{{ url('/users/'.$data->id) }}" method="post" enctype="multipart/form-data">

            @csrf
            @method('put')

            <input type="hidden" name="id" value="{{$data->id}}" >


            <div class="form-group">
                <label for="exampleInputName">name</label>
                <input type="text" name="name" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Name" value="{{ $data->name }}">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">email</label>
                <input type="email" name="email" class="form-control" value="{{ $data->email }}">
            </div>

            <button type="submit" class="btn btn-primary">update</button>
        </form>
    </div>

</body>

</html>
