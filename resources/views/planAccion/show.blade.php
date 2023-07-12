@extends('dashboard.app')
@section('title')
    PlanAcción
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Plan de Acción de la Evaluación N°{{ $paccion->evaluacionId }}</h3>




            @php
                $band = DB::table('seguimientos')
                    ->where('pAccionId',$paccion->id)
                    ->exists();
            @endphp
            @if ($band)

            <a href="{{ route('seguimiento.show',$paccion->id) }}"  class="btn btn-primary cursor-pointer mr-25px" style="text-align: end" >
                <span>
                    <i class="fas fa-file" style="color: #faf8f5"></i>
                </span> Ver Acción Seguimiento
            </a>
          
            @else
            <a href="{{ route('seguimiento.crear',$paccion->id) }}"  class="btn btn-primary cursor-pointer mr-25px"  >
                <span>
                    <i class="fas fa-plus" style="color: #faf8f5"></i>
                </span>Acción Seguimiento
            </a>
            @endif













{{-- 
            <a href="{{ route('seguimiento.crear',$paccion->id) }}"  class="btn btn-primary cursor-pointer mr-25px"  >
                <span>
                    <i class="fas fa-plus" style="color: #faf8f5"></i>
                </span>Acción Seguimiento
            </a>
            <a href="{{ route('seguimiento.show',$paccion->id) }}"  class="btn btn-primary cursor-pointer mr-25px" style="text-align: end" >
                <span>
                    <i class="fas fa-file" style="color: #faf8f5"></i>
                </span> Ver Acción Seguimiento
            </a> --}}
          
        </div>
        <div class="section-body">
            <div class="card mb-3" style="max-width: 500px; max-height: 610px;">
                <img src="{{ asset('img/psicotricimidad.png') }}" class="card-img-top" alt="..." width="400"
                    height="300">
                <div class="card-body">
                    <form method="post" action="{{route('planAccion.update',$paccion->id)}}" novalidate >
                        @csrf
                        @method('PUT')
            
                        <div class="row">
                            <div id="plan" class="card"
                                style="width: 30rem;   margin-top: 0px; 
                            margin-bottom: 5px;
                            margin-left: 0px;
                            margin-right: 0px;  ">
                                <div class="card-body">
                                    <label for="">Plan De Acción Evaluación N° {{$paccion->evaluacionId}}</label>
                                    <textarea name="descripcionPA" rows="4" cols="50" value="">  {{old('descripcionPA',$paccion->descripcionPA)}}              
                                    </textarea>


                                </div>
                            </div>
                            <input type="text" id="miInput"name="evaluacionId"  value="{{old('evaluacionId', $paccion->evaluacionId)}}"  style="display: none;">

                        </div>
                        <div class="row">
                            <label class="form-label">Fecha:</label>
                            <input type="date" class="form-control " name="date" value="{{old('date',$paccion->date)}}"
                                style=" margin-top: 0px; margin-bottom: 8px; height: 33px; background-color: rgb(236, 232, 232); color: rgb(3, 3, 3);">


                           <button type="submit" class="btn btn-primary cursor-pointer">
                            
                                <span>
                                    <i class="fas fa-file-download" style="color: #faf8f5"></i>
                                </span>Actualizar
                         
                           </button>
                        </div>

                   </form>
                </div>

            </div>

    </section>
@stop
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@stop
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
@stop