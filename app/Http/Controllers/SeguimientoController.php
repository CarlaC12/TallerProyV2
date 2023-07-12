<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PAccion;
use App\Models\Seguimiento;
use Illuminate\Support\Facades\DB;
class SeguimientoController extends Controller
{
    
    public function index()
    {
        return view('seguimiento.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('seguimiento.create');
    }


    public function crear($id)
    {
        $pAccion=PAccion::find($id);
        return  view('seguimiento.create',compact('pAccion'));
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
            'descripcionMG' => 'required',
            'descripcionMF' => 'required',
            'descripcionAL' => 'required',
            'descripcionPS' => 'required',
         
            'pAccionId' => 'required',     
        ]);

        $seguimiento=new Seguimiento();
        $seguimiento->descripcionMG = $request->input('descripcionMG');
        $seguimiento->descripcionMF = $request->input('descripcionMF');
        $seguimiento->descripcionAL = $request->input('descripcionAL');
        $seguimiento->descripcionPS = $request->input('descripcionPS');
       
        $seguimiento->pAccionId = $request->input('pAccionId');
      
        $seguimiento->save();
       
          
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
        $seguimiento=DB::table('seguimientos')->where('pAccionId',$id)->get()->first();
        return view('seguimiento.show',compact('seguimiento'));
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
            'descripcionMG' => 'required',
            'descripcionMF' => 'required',
            'descripcionAL' => 'required',
            'descripcionPS' => 'required',
         
            'pAccionId' => 'required',     
        ]);
        // $seguimiento=DB::table('seguimientos')->where('pAccionId',$id)->get()->first();
        $seguimiento=Seguimiento::findOrfail($id);
        $seguimiento->descripcionMG = $request->input('descripcionMG');
        $seguimiento->descripcionMF = $request->input('descripcionMF');
        $seguimiento->descripcionAL = $request->input('descripcionAL');
        $seguimiento->descripcionPS = $request->input('descripcionPS');
       
        $seguimiento->pAccionId = $request->input('pAccionId');
        $seguimiento->update();

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
