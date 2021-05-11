<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $datos['empleados']=Empleado::paginate(10);
        return view ('empleado.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $campos=[

            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correo'=>'required|email',
            'Foto'=>'required|max:100000|mines:jpeg,png,jpg'
        ];

        $mensaje=[
                'required'=>'El :attribute es requerido',
                'Foto.required'=>'La Foto es Requerida'

        ];

        $this->validate($request,$campos,$mensaje);

       // $datosEmpleado = request()->all();
       $datosEmpleado = request()->except('_token');

       if($request->hasFile('Foto')){
        $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');

       }


       Empleado::insert($datosEmpleado);

       //return response()->json($datosEmpleado);
       return redirect('empleado')->with('mensaje','Empleado agregado conexito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $empleado=Empleado::FindOrFail($id);
        return view ('empleado.edit',compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $datosEmpleado =request()->except(['_token','_method']);//

        if($request->hasFile('Foto')){
            $empleado=Empleado::FindOrFail($id);

            

            Storage::delete ('public/'.$empleado->Foto);
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');


            
            return redirect('empleado')->with('mensaje','Empleado Modificado');
    
           }





        Empleado::where('id','=',$id)->update($datosEmpleado);

        $empleado=Empleado::FindOrFail($id);
        return view ('empleado.edit',compact('empleado'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)

    {
        $empleado=Empleado::FindOrFail($id);
        if(Storage::delete('public/'.$empleado->Foto));{//Pregunta si existe el registro de la imagen 

            Empleado::destroy($id);//Borrar la imagen

        }
       
        //return redirect('empleado');

        return redirect('empleado')->with('mensaje','Empleado Borrado');
    }
}
