@extends('dashboard.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fa fa-users f-left"></i>
                        </div>

                        <div class="text-end pt-1">
                            <h4 class="mb-0">Usuarios</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        @php
                            use Spatie\Permission\Models\Role;
                            $cant_roles = Role::count();
                        @endphp
                        <h2 class="text-right"><span>{{ $cant_roles }}</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-info shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fas fa-file f-left"></i>
                        </div>
                        <div class="text-end pt-1">
                            <h4 class="mb-0">Evaluaciones</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        @php
                            use App\Models\Evaluacion;
                            $cant_blogs = Evaluacion::count();
                        @endphp
                        <h2 class="text-right"><span>{{ $cant_blogs }}</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fas fa-people-carry f-left"></i>
                        </div>
                        <div class="text-end pt-1">
                            <h4 class="mb-0">Personal</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        @php
                            use App\Models\Personal;
                            $cant_blogs = Personal::count();
                        @endphp
                        <h2 class="text-right"><span>{{ $cant_blogs }}</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-primary shadow-info text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fas fa-child f-left"></i>
                        </div>
                        <div class="text-end pt-1">

                            <h4 class="mb-0">Infantes</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        @php
                        use App\Models\Infante;
                        $cant_blogs = Infante::count();
                    @endphp
                    <h2 class="text-right"><span>{{ $cant_blogs }}</span>
                    </h2>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-4">


            <div class="col-lg-4 col-md-6 mt-4 mb-4">
                <div class="card z-index-2 ">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                            <div class="chart">

                                <img alt="image" src="{{ asset('img/1.jpg') }}" height="170">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-0 ">Motricidad Gruesa</h6>
                        <p><small>
                                La motricidad gruesa se refiere al desarrollo y control de los movimientos musculares
                                grandes y coordinados del cuerpo, como caminar, correr y saltar. Estos movimientos implican
                                el uso de grupos musculares principales y contribuyen al desarrollo físico, equilibrio y
                                coordinación.</small></p>

                    </div>
                </div>
            </div>


            <div class="col-lg-4 col-md-6 mt-4 mb-4">
                <div class="card z-index-2  ">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                        <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                            <div class="chart">
                                <img alt="image" src="{{ asset('img/2.jpg') }}" height="170">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-0 "> Motricidad Fino </h6>
                        <p><small>La motricidad fina se refiere al desarrollo y control de los movimientos musculares
                                pequeños y precisos, especialmente en las manos y los dedos. Involucra habilidades como
                                agarrar objetos, escribir, recortar con tijeras y abotonarse la ropa. Estas destrezas
                                requieren coordinación mano-ojo.</small></p>

                    </div>
                </div>
            </div>

            <div class="col-lg-4 mt-4 mb-3">
                <div class="card z-index-2 ">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                            <div class="chart">
                                <img alt="image" src="{{ asset('img/3.jpg') }}" height="170">

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-0 ">Audición y Lenguaje</h6>
                        <p><small>La audición y el lenguaje son dos aspectos interrelacionados del desarrollo humano. La
                                audición se refiere a la capacidad de percibir y procesar los sonidos, mientras que el
                                lenguaje implica la habilidad de comprender y comunicarse a través de palabras y estructuras
                                lingüísticas.</small>
                        </p>
                    </div>
                </div>
            </div>



        </div>


    </div>
@endsection

@section('css')

@stop
