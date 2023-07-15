@extends('dashboard.app')
@section('title')
    Evaluaciones
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Información</h3>
            @if ($resulMG->count() > 0 || $resulMF->count() > 0 || $resulAL->count() > 0 || $resulPS->count() > 0)
                @php
                    $variables = [$resulMG, $resulMF, $resulAL, $resulPS];
                    $contador = 0;
                    
                    foreach ($variables as $variable) {
                        if ($variable->count() > 0) {
                            $contador++;
                        }
                    }
                    
                    if ($contador >= 2) {
                        echo '<div class="alert alert-success" role="alert" style="max-width: 740px; max-height: 70px;">';
                        echo '<h3 style="align-content: center; color: white;">fallo Absoluto</h3>';
                        echo '</div>';
                    } else {
                        echo '<div class="alert alert-warning" role="alert" style="max-width: 740px; max-height: 70px;">';
                        echo '<h3 style="align-content: center; color: white;">fallo Relativo</h3>';
                        echo '</div>';
                    }
                @endphp
            @else
                <div class="alert alert-info" role="alert" style="max-width: 740px; max-height: 70px;">
                    <h1 style="align-content: center; color: white;">Evaluación Exitosa</h1>
                </div>
            @endif

            @php
                $paccion = DB::table('p_accions')
                    ->where('evaluacionId', $evaluacion->id)
                    ->exists();
            @endphp
            @if ($paccion)

            <a href="{{ route('PAccion', $evaluacion->id) }}" class="btn btn-primary cursor-pointer mr-25px"  style="display: none;>
                <span>
                    <i class="fas fa-plus" style="color: #faf8f5"></i>
                </span>Plan Accion
            </a>
            @else
                <a href="{{ route('PAccion', $evaluacion->id) }}" class="btn btn-primary cursor-pointer mr-25px">
                    <span>
                        <i class="fas fa-plus" style="color: #faf8f5"></i>
                    </span>Plan Accion
                </a>
            @endif
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-3" style="max-width: 740px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset('img/prefile2.jpg') }}" class="img-fluid rounded-start" style="height:90%;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <p class="card-text">
                                        <div class="author">
                                            <p class="card-text">
                                                <label for="nombre" class="col-form-label">Nombre del menor: </label>
                                                {{ $evaluacion->infante->nombre }} {{ $evaluacion->infante->apellidoPaterno }}
                                                {{ $evaluacion->infante->apellidoMaterno }} <br>
                                                <label for="edad" class="col-form-label">Edad: </label>
                                                {{ $evaluacion->edadMeses }} meses<br>
                                                <label for="fecha" class="col-form-label">Fecha de evaluación: </label>
                                                {{ $evaluacion->fecha }} <br>
                                                <label for="personal" class="col-form-label">Nombre del Evaluador: </label>
                                                {{ $evaluador->name }} <br>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                <div class="card mb-3" style="max-width: 740px;">
                    <div class="thermometer-container d-flex justify-content-between">
                     @foreach ($data as $emocion => $cantidad)
                            @if ($cantidad != 0)
                                <div class="thermometer">
                                    <div class="thermometer-icon">
                                        @if ($emocion == 'happy')
                                            <i class="far fa-smile" style="font-size: 48px; color: #FFCE00;"></i>
                                        @elseif ($emocion == 'sad')
                                            <i class="far fa-frown" style="font-size: 48px; color: #0080FF;"></i>
                                        @elseif ($emocion == 'angry')
                                            <i class="far fa-angry" style="font-size: 48px; color: #FF4545;"></i>
                                        @elseif ($emocion == 'disgust')
                                            <i class="far fa-dizzy" style="font-size: 48px; color: #800080;"></i>
                                        @elseif ($emocion == 'surprise')
                                            <i class="fas fa-exclamation" style="font-size: 48px; color: #FF8C00;"></i>
                                        @elseif ($emocion == 'neutral')
                                            <i class="far fa-meh" style="font-size: 48px; color: #A0A0A0;"></i>
                                        @elseif ($emocion == 'fear')
                                            <i class="far fa-grimace" style="font-size: 48px; color: #00B000;"></i>
                                        @endif
                                    </div>
                                    <div class="thermometer-progress" style="width: {{ $cantidad }}%; background-color: #00ff00;"></div>
                                    <div class="thermometer-value">{{ $cantidad }}</div>
                                    <div class="thermometer-name">{{ $emocion }}</div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection

@section('styles')
    <style>
        .thermometer-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .thermometer {
            width: calc(100% / {{ count($data) }});
            height: 100px;
            background-color: #eee;
            border-radius: 10px;
            margin-bottom: 20px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .thermometer-progress {
            height: 100%;
            transition: width 0.3s ease-in-out;
        }

        .thermometer-icon {
            position: absolute;
            top: 0;
            transform: translateY(-50%);
            text-align: center;
        }

        .thermometer-value {
            font-weight: bold;
            font-size: 24px;
        }

        .thermometer-name {
            font-size: 14px;
            text-align: center;
            margin-top: 10px;
        }
    </style>
@endsection