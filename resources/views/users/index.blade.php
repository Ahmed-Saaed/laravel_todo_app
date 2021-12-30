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
    <div>
    <div class="container m-5">
        <div class="page-header">
            <h1 >users</h1>
            <br>
            @auth()
            {{ 'Welcome , '.auth()->user()->name}}
            @endauth
            <a href="{{url('/logout')}}" class="btn btn-danger my-3">log out</a>

             {{  session()->get('Message')  }}
        </div>
        <div class="row">
    <table class="table table-dark table-hover col-6 p-2">
            <thead>
                <tr>
                <th scope="col p-2">id</th>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody class="p-2">
                @foreach ($data as  $key => $value)
                <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->name}}</td>
                <td>{{$value->email}}</td>
                <td>
                    <a href='' data-toggle="modal" data-target="#modal_single_del{{$key}}" class='btn btn-danger m-r-1em'>Remove </a>
                    <a href='{{url('/users/'.$value->id.'/edit')}}' class='btn btn-primary m-r-1em'>Edit</a>
                </td>
                </tr>

                    {{-- end of table start of modal --}}
                <div class="modal bg-transparent " id="modal_single_del{{$key}}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content bg-dark text-white">
                            <div class="modal-header">
                                <h5 class="modal-title">delete confirmation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                           </button>
                            </div>

                            <div class="modal-body text-dark">
                              Remove {{ $value->name  }} !!
                            </div>
                            <div class="modal-footer">
                                <form action="{{url('/users/'.$value->id)}}" method="post">
                                      @csrf
                                      {{-- <input type="hidden" name="_method" value="delete"> --}}
                                      @method('delete')

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
            </tbody>
    </table>
</div>
</div>
</div>
</body>
</html>
