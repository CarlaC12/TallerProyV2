<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvaluacionDenver;
use App\Models\PAccion;
use Illuminate\Support\Facades\DB;
class PlanAccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    //    return view('planAccion.create');
    }


    public function crear($id)
    {
        $evaluacion=EvaluacionDenver::find($id);
       return view('planAccion.create',compact('evaluacion'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'descripcionPA' => 'required',
            'date' => 'required',
            'evaluacionId' => 'required',     
        ]);
        $paccion = new PAccion();
        $paccion->descripcionPA = $request->input('descripcionPA');
        $paccion->date = $request->input('date');
        $paccion->evaluacionId = $request->input('evaluacionId');
      
        $paccion->save();
       
          
          return redirect()->route('evaluaciones.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paccion=DB::table('p_accions')->where('evaluacionId',$id)->get()->first();
       return view('planAccion.show',compact('paccion'));
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
        $this->validate($request, [
            'descripcionPA' => 'required',
            'date' => 'required',
            'evaluacionId' => 'required',     
        ]);
        $paccion=PAccion::find($id);
        $paccion->descripcionPA = $request->input('descripcionPA');
        $paccion->date = $request->input('date');
        $paccion->evaluacionId = $request->input('evaluacionId');
      
        $paccion->save();
        return redirect()->route('evaluaciones.index');
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
