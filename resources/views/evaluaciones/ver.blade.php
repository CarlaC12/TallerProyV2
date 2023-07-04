@extends('dashboard.app')
@section('title')
    Evaluaciones
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Información</h3>
            <a href="{{ route('PAccion',$evaluacion->id) }}"  class="btn btn-primary cursor-pointer mr-25px"  >
                <span>
                    <i class="fas fa-plus" style="color: #faf8f5"></i>
                </span>Plan Accion
            </a>
           
        </div>
        <div class="section-body">
            <div class="card mb-3" style="max-width: 740px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ asset('img/prefile2.jpg') }}" class="img-fluid rounded-start" style="height:90%;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <p class="card-text">
                            <div class="author">
                                <p class="card-text ">
                                    <label for="nombre" class="col-form-label">Nombre del menor: </label>
                                    {{ $evaluacion->infante->nombre }} {{ $evaluacion->infante->apellidoPaterno }}
                                    {{ $evaluacion->infante->apellidoMaterno }} <br>
                                    <label for="edad" class="col-form-label">Edad: </label>
                                    {{ $evaluacion->edadMeses }} meses<br>
                                    <label for="fecha" class="col-form-label">Fecha de evaluación: </label>
                                    {{ $evaluacion->fecha }} <br>
                                    <label for="personal" class="col-form-label">Nombre del Evaluador: </label>
                                    {{ $evaluacion->personal->name }} <br>

                                    <label for="resultadoMG" class="col-form-label">Total Motricidad Gruesa: </label>
                                    @foreach ($MG as $mg)
                                        <br>{{ $mg->pregunta }}<br>
                                    @endforeach

                                    <label for="resultadoMG" class="col-form-label">Total Motricidad Fino Adaptativa:
                                    </label>
                                    @foreach ($MF as $mf)
                                        <br>{{ $mf->pregunta }}<br>
                                    @endforeach

                                    <label for="resultadoMG" class="col-form-label">Total Audición y Lenguaje: </label>
                                    @foreach ($AL as $al)
                                        <br>{{ $al->pregunta }}<br>
                                    @endforeach

                                    <label for="resultadoMG" class="col-form-label">Total Personal Social: </label>
                                    @foreach ($PS as $ps)
                                        <br>{{ $ps->pregunta }}<br>
                                    @endforeach

                                </p>
                            </div>
                            </p>
                            <div class="row">
                                <div class="d-grid gap-2 col-6 mx-auto">
                                    <a href="{{ route('evaluaciones.index') }}" class="btn btn-primary">Volver</a>
                                </div>
                                <div class="d-grid gap-2 col-6 mx-auto">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>






@stop



