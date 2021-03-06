<?php

namespace healthy\Http\Controllers;

use healthy\Note;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Request;
//use Illuminate\Support\Facades\Redirect;

use healthy\Http\Requests;
use healthy\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::paginate(20);
        return view('notes/list',compact('notes'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
       public function create()
    {
        //
        return view('notes/create');
    }

    /*public function postCrear(Request $request){
     *return $request->all/();
     *}
     */



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * (Request $request)
     */
    public function store()
    {
        //
        //return 'Creating a note';
        //return $request->only(['note']);

        $this->validate(request(),[
           'note' => ['required','max:200']
        ]);
       // return Request::only
        $data= request()->all();

        Note::create($data);

        //return redirect::to('notes');
    return redirect()->to('notes');




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($note)
    {
        //
        //dd($note);
       $note=Note::findOrFail($note);
        //return view('notes/details',compact('note'));
        return view('notes/details')->with('note',$note);
        //return $note->note;
        //return view('notes/details',['note' => $note]);
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
    }
}
