<?php

namespace App\Http\Controllers;

use App\Models\todo;
use Illuminate\Http\Request;

class todoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get the data of the signed user
        $data = todo::where('added_by', auth()->user()->id)->get();

        return view('todo.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('todo.create');
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

        $data = $this->validate(
            request(),
            [
                "title"   => "required|min:5",
                "content" => "required|min:10",
                "startdate" => 'required|date|after:now',
                "enddate" => 'required|date|after:now',
                "image"   => "required|image|mimes:png,jpg,gif,svg"
            ]
        );

        $FinalName = time() . rand() . '.' . $request->image->extension();

        # Storage/App/ ...
        // $request->image->storeAs('blogImages',$FinalName);


        # public folder
        if ($request->image->move(public_path('todoImages'), $FinalName)) {

            $data['image'] = $FinalName;
            $data['added_by'] = auth()->user()->id;

            $op =  todo::create($data);

            if ($op) {
                $message = "Raw Inserted";
            } else {
                $message = "Error Try Again";
            }
        } else {
            $message = "Error In Uploading Try Again";
        }

        session()->flash('Message', $message);

        return redirect(url('/todo'));
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
        $data = todo::find($id);
        return view('todo.edit', ['data' => $data]);
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

        # Validate Data .....
        $data =   $this->validate($request, [
            "title"     => "required|min:3",
            "content"    => "required|string",
            "startdate" => 'required|date|after:now',
            "enddate" => 'required|date|after:now',
            "image"   => "image|mimes:png,jpg,gif,svg"
        ]);

        $id = $request->id;
        $oldData = todo::find($id);

        if ($request->image) {
            $FinalName = time() . rand() . '.' . $request->image->extension();
            unlink(public_path('todoImages/' . $oldData['image']));
            $request->image->move(public_path('todoImages'), $FinalName);
        } else {
            $FinalName = $oldData['image'];
        }
        # public folder

        $data['image'] = $FinalName;
        $data['added_by'] = auth()->user()->id;

        $op = todo::where('id', $id)->update($data);

        if ($op) {
            $message = "Raw Updated";
        } else {
            $message = "Error Try Again";
        }


        session()->flash('Message', $message);
        return redirect(url('/todo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $data = todo::find($id);

        if (strtotime($data['enddate']) > strtotime($request->enddate)) {
            $op  =  todo::where('id', $id)->delete();

            if ($op) {
                unlink(public_path('todoImages/' . $data->image));
                $message = "Raw Removed";
            } else {
                $message = "Error Try Again";
            }
        } else {
            $message = "task is already expired";
        }
        session()->flash('Message', $message);
        return redirect(url('/todo'));
    }
}