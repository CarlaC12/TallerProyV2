@extends('dashboard.app')
@section('title')
    Seguimiento Show|Edit
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Plan de Acción N° {{ $seguimiento->id}} en Seguimiento</h3>
        </div>
        <div class="section-body">
            <div class="card mb-3" style="max-width: 740px;">
                <form method="post"  action="{{route('seguimiento.update',$seguimiento->id)}}" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row g-0">
                        <div class=" col-md-4">
                            <div class="card"
                                style="width: 15rem; background-color: rgba(5, 255, 101, 0.63);  margin-bottom: 5px;">
                                <div class="card-body">

                                    <img src="{{ asset('img/1.jpg') }}" class="img-fluid rounded-start"
                                        style="height:90%; border-radius: 40%;">

                                </div>
                            </div>

                            <div class="card text-center"
                                style="width: 15rem; background-color: rgb(29, 14, 243);  margin-bottom: 15px;">
                                <div class="card-body">

                                    <img src="{{ asset('img/2.jpg') }}" class="img-fluid rounded-end"
                                        style="height:70%;  border-radius: 40%;">
                                </div>
                            </div>

                            <div class="card text-end"
                                style="width: 15rem;  background-color: rgb(243, 14, 193);  margin-bottom: 20px;">
                                <div class="card-body">
                                    <img src="{{ asset('img/3.jpg') }}" class="img-fluid rounded-start"
                                        style="height:90%;  border-radius: 40%;">

                                </div>
                            </div>
                            <div class="card text-end" style="width: 15rem; background-color: rgb(209, 255, 5);">
                                <div class="card-body">

                                    <img src="{{ asset('img/4.jpg') }}" class="img-fluid rounded-end"
                                        style="height:90%;  border-radius: 40%;">
                                </div>
                            </div>

                        </div>


                        <div class="col-md-8">
                            <div class="row">
                                <div id="desc" class="card"
                                    style="width: 30rem;   margin-top: 5px; 
                        margin-bottom: 5px;
                         margin-left: 15px;
                          margin-right: 15px;  ">
                                    <div class="card-body">
                                        <label for="">Descripcion de Motricidad Gruesa</label>
                                        <textarea name="descripcionMG" rows="4" cols="50">{{old('descripcionMG',$seguimiento->descripcionMG)}}                
                                    </textarea>


                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div id="desc" class="card"
                                    style="width: 30rem;   margin-top: 5px; 
                        margin-bottom: 15px;
                         margin-left: 15px;
                          margin-right: 15px;  ">
                                    <div class="card-body">
                                        <label for="">Descripcion de Motricidad Fina</label>

                                        <textarea name="descripcionMF" rows="4" cols="50">{{old('descripcionMF',$seguimiento->descripcionMF)}}
                                   
                                    </textarea>


                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div id="desc" class="card"
                                    style="width: 30rem;   margin-top: 0px; 
                        margin-bottom: 5px;
                         margin-left: 15px;
                          margin-right: 15px;  ">
                                    <div class="card-body">
                                        <label for="">Audición Lenguaje</label>

                                        <textarea name="descripcionAL" rows="4" cols="50">{{old('descripcionAL',$seguimiento->descripcionAL)}}
                                   
                                    </textarea>


                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div id="desc" class="card"
                                    style="width: 30rem;   margin-top: 0px; 
                        margin-bottom: 5px;
                         margin-left: 15px;
                          margin-right: 15px;  ">
                                    <div class="card-body">
                                        <label for="">Personal Social</label>

                                        <textarea name="descripcionPS" rows="4" cols="50">{{old('descripcionPS',$seguimiento->descripcionPS)}}
                                   
                                    </textarea>


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <input type="text" name="pAccionId"  value="{{old('pAccionId', $seguimiento->pAccionId)}}"  style="display: none;">
                    <div class="row"
                        style="margin-top: 15px;
                
                         margin-left: 20px;
                          margin-right: 20px; ">
                          <button type="submit"class="btn btn-primary cursor-pointer">
                            <span>
                                <i class="fas fa-file-download" style="color: #faf8f5"></i>
                            </span>Actualizar  
                          </button>
                        {{-- <div class="d-grid gap-2 col-12 mx-auto">
                            <a href="" class="btn btn-primary">Guardar</a>
                        </div> --}}
                    </div>


                </form>

            </div>


        </div>

    </section>


@stop
@section('css')
    <style>
        h3 {
            text-align: center;
        }
    </style>
@stop

@section('js')
    <script>
        // Obtener la referencia al elemento textarea
        var textarea = document.getElementById("desc");

        // Establecer el foco en el textarea y colocar el cursor al inicio
        textarea.focus();
        textarea.setSelectionRange(0, 0);
    </script>
@stop