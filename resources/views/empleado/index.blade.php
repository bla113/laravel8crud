@extends('layouts.app')

@section('content')
<div class="container">

<div class="alert slert-succes alert-dismissible" role="alert">
@if(Session::has('mensaje'))

{{Session::get('mensaje') }}


@endif



<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>

</button>


</div>





<a href="{{url('empleado/create')}}" class="btn btn-success">Registrar Nuevo Empeleado</a>
<table class="table table-light">
    <thead >
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido Materno</th>
            <th>Apellido Paterno</th>
            <th>Correo</th>
            <th>Acciones</th>
          
        </tr>
    </thead>
    <tbody>
    @foreach($empleados as $empleado)
        <tr>
            <td>{{$empleado->id}}</td>

        
            <td><img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$empleado->Foto}}" alt="" width="50"></img></td>

            <td>{{$empleado->Nombre}}</td>
            <td>{{$empleado->ApellidoPaterno}}</td>
            <td>{{$empleado->ApellidoMaterno}}</td>
            <td>{{$empleado->Correo}}</td>
            <td>
            
            <a href="{{url('/empleado/'.$empleado->id.'/edit')}}" class="btn btn-warning">
            Editar
            
            </a>
            <form action="{{ url ('/empleado/'.$empleado->id) }}  " class="d-inline" method="post">
            @csrf <!--EVITA QUE CUALQUIER FORMULARIO ACCEDA A LA INFORMACIÒN  -->
            {{method_field('DELETE') }} <!--METODO PARA BORRAR/   -->
            
            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Quieres Borrar el Registro')" class="btn btn-primary">Borrar</button>


            </td>

            

            
            
            </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
@endsection
