

<form action="{{ url('/empleado') }}" method="post" enctype="multipart/formdata">
@csrf
<h1>{{$modo}} empleado</h1>

@if(count($errors)>0)

<div class="alert alert-danger" role="alert">
<ul>
    @foreach($errors->all() as $error)

   <li>{{$error}}</li> 

    @endforeach


    </ul>
</div>



@endif




<div class="form-group">
<div>
<label for="Nombre">Nombre</label>
<input type="text" class="form-control" name="Nombre" value="{{isset($empleado->Nombre)?$empleado->Nombre:'' }}" id="Nombre">
</div>
</div>

<div class="form-group">
<div>
<label for="ApellidoPaterno">ApellidoPaterno</label>
<input type="text"class="form-control" name="ApellidoPaterno" value="{{isset($empleado->ApellidoPaterno)?$empleado->ApellidoPaterno:'' }}"  id="ApellidoPaterno" >
</div>
</div>

<div class="form-group">
<div>
<label for="ApellidoMaterno">ApellidoMaterno</label>
<input type="text" class="form-control" name="ApellidoMaterno" value="{{isset($empleado->ApellidoMaterno)?$empleado->ApellidoMaterno:'' }}">
</div>
</div>

<div class="form-group">
<div>
<label for="Correo">Correo</label>
<input type="text" class="form-control" name="Correo" value="{{isset($empleado->Correo)?$empleado->Correo:'' }}" id="Correo">
</div>
</div>


<div class="form-group">
<label for="Foto">Foto</label>
@if(isset($empleado->Foto))
{{$empleado->Foto}}
<img src="{{asset('storage').'/'.$empleado->Foto}}" class="img-thumbnail img-fluid" alt="" width="100px"></img>

@endif

<input type="file" class="form-control" name="Foto" value="" id="Foto">
</div>

<div class="form-group">
<input type="submit" class="btn btn-primary" value="{{ $modo }} datos"  >

<a href="{{url('empleado/')}}" class="btn btn-success">Regresar</a>

</div>
</div>
</form>