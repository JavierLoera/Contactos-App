<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contacto;
use App\Models\User;

class ContactoController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contactos=Contacto::where('user_id',Auth::user()->id)->orderBy('created_At','desc')->get();
        return view('home', compact('contactos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *///
       public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|string|max:255',
            'numero' => 'required',
        ]);

        $contacto = new Contacto;
        $contacto->nombre = $request->input('nombre');
        $contacto->numero = $request->input('numero');


        $contacto->user_id = Auth::user()->id;

        $contacto->save();

        return 
        redirect()->route('contactos.index')->with('success', 'Contacto creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $contacto=Contacto::where('id',$id)->where('user_id',Auth::user()->id)->first();
       if(!$contacto){
            abort(404);
        }
       return view ('delete',compact('contacto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contacto= Contacto::where('id', $id)->where('user_id',Auth::user()->id)->first();
        if(!$contacto){
            abort(404);
        }
        return view('edit',compact('contacto'));
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
          $this->validate($request, [
            'nombre' => 'required|string|max:255',
            'numero' => 'required',
        ]);

        $contacto =Contacto::find($id);
        $contacto->nombre = $request->input('nombre');
        $contacto->numero = $request->input('numero');


        $contacto->user_id = Auth::user()->id;

        $contacto->save();

        return back()->with('success', 'Contacto actualizado');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $contacto=Contacto::where('id', $id)->where('user_id',Auth::user()->id)->first();
     $contacto->delete();
     return redirect()->route('contactos.index')->with('eliminado', 'Contacto eliminado');
    }
}
