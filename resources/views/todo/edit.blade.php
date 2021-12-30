

<!DOCTYPE html>
<html lang="en">
<head>
  <title>todo</title>
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


  <h2>edit your task</h2>
  <form  action="{{ url('/todo/'.$data->id) }}" method="post" enctype="multipart/form-data">

    @csrf
    @method('put')

    <input type="hidden" name="id" value="{{$data->id}}" >


  <div class="form-group">
    <label for="exampleInputName">Title</label>
    <input type="text" name="title" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Name" value="{{ $data->title }}">
  </div>


  <div class="form-group">
    <label for="exampleInputEmail">Content</label>
       <textarea  name="content"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >{{ $data->content }}</textarea>
  </div>


  <div class="form-group">
    <label for="exampleInputPassword">Image</label>
    <input type="file" name="image">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword">start date</label>
    <input type="datetime-local" name="startdate" value="{{ $data->startdate }}">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword">end date</label>
    <input type="datetime-local" name="enddate" value="{{ $data->enddate}}">
  </div>

  <br>

  <img src="{{asset('todoImages/'.$data->image)}}" alt="" height="100px" width="100px">
  <br>


  <button type="submit" class="btn btn-primary">Save</button>
</form>
</div>

</body>
</html>
