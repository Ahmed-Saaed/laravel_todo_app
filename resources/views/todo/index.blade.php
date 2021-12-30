<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>
<div class="bg-dark text-white">
    <div class="container">
        <div class="page-header pt-5">
            <h1>TODO list</h1>
            <br>
            <a href="{{url('/logout')}}" class="btn btn-danger my-3">log out</a>


            {{ 'Welcome , '.auth()->user()->name}}


             {{  session()->get('Message')  }}
        </div>
        <div class="row">
                @foreach ($data as  $key => $value)
                <div class="card col-4 m-3" style="width: 18rem;">
                    <img src="{{asset('todoImages/'.$value->image)}}" alt="" height="200px" width="100px" class="card-img-top my-2">
                    <div class="card-body">
                      <h5 class="card-title text-primary">{{$value->title}}</h5>
                      <p class="card-text"></p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item"> description: {{$value->content}}</li>
                      <li class="list-group-item">start date: {{$value->startdate}}</li>
                      <li class="list-group-item">end date: {{$value->enddate}}</li>
                    </ul>
                    <div class="card-body">
                    <a href='' data-toggle="modal" data-target="#modal_single_del{{$key}}" class='btn btn-danger card-link   m-r-1em'>Remove </a>
                    <a href='{{url('/todo/'.$value->id.'/edit')}}' class='btn btn-primary card-link m-r-1em'>Edit</a>
                    </div>
                </div>

                    {{-- end of table start of modal --}}
                <div class="modal" id="modal_single_del{{$key}}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">delete confirmation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                           </button>
                            </div>

                            <div class="modal-body text-dark">
                              Remove {{ $value->title  }}!
                            </div>
                            <div class="modal-footer">
                                <form action="{{url('/todo/'.$value->id)}}" method="post">
                                      @csrf
                                      @method('delete')
                                      <input type="hidden" name="enddate" value="{{ $value->endate}} ">

                                    <div class="not-empty-record">
                                        <button type="submit" class="btn btn-primary">Delete</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>
