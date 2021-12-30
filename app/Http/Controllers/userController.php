<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (auth()->user()) {
            $data = User::get();
            return view('users.index', ['data' => $data]);
        } else {
            return redirect('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        # Validate Data .....
        $data =   $this->validate($request, [
            "name"     => "required|min:3",
            "password" => "required|min:6",
            "email"    => "required|email",
        ]);


        $data['password'] =  bcrypt($data['password']);

        $op = User::create($data);

        if ($op) {
            $message = "now you can login.";
        } else {
            $message = 'Error Try Again !';
        }


        // session()->put('Message',$message);    // $_SESSION['KEY'] => $VALUE
        session()->flash('Message', $message);
        auth()->logout();
        return redirect(url('login'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = User::find($id);

        return view('users.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // code ......

        # Validate Data .....
        $data =   $this->validate($request, [
            "name"     => "required|min:3",
            "email"    => "required|email",
        ]);

        $id = $request->id;

        $op = User::where('id', $id)->update($data);

        if ($op) {
            $message = "Raw Updated";
        } else {
            $message = "Error Try Again";
        }

        session()->flash('Message', $message);
        return redirect(url('/users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $op  =  User::where('id', $id)->delete();

        if ($op) {
            $message = "Raw Removed";
        } else {
            $message = "Error Try Again";
        }
        session()->flash('Message', $message);
        return redirect(url('/users'));
    }

    #auth
    public function Login()
    {
        return view('users.login');
    }



    public function DoLogin(Request $request)
    {
        // logic .....

        $data = $this->validate($request, [
            "email"    => "required|email",
            "password" => "required|min:6"
        ]);

        //auth()->guard('admin')->attempt($data)

        if (auth()->attempt($data)) {
            return redirect(url('/users'));
        } else {
            return redirect('login');
        }
    }



    public function logout()
    {
        auth()->logout();
        return redirect(url('login'));
    }
}