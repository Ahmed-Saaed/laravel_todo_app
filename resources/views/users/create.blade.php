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

        <div class="container bg-dark text-white">

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

                <div class="container col-6">
            <h2>register</h2>

            <form action="{{ url('/users') }}" method="post" enctype="multipart/form-data">

                @csrf

                <div class="form-group">
                    <label for="exampleInputName">name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Name" value="{{ old('title') }}">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword">email</label>
                    <input type="email" name="email" class="form-control" placeholder="enter valid email">
                </div>

                <div class="form-group">
                    <label for="exampleInputName">password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Name" value="{{ old('title') }}">
                </div>

                <button type="submit" class="btn btn-primary">register</button>
            </form>
            </div>
        </div>

    </body>

    </html>
