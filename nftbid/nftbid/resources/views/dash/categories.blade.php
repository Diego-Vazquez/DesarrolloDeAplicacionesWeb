@extends('dash.index')

@section('contenido')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Categorías</h1>
        <a href="#" data-toggle="modal" data-target = "#modaladd" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i>Agregar Categoría</a>
    </div>
</div>
<!-- ERRORES -->
        @if($message = Session::get('ErrorInsert'))
            <div class="row alert alert-danger alert-dismissable fade show" role="alert">
                <h5>Error: {{$message}}</h5>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            @if($message = Session::get('listo'))
            <div class="row alert alert-success fade show">
                <h5 class="col-12"><i class="fa fa-check"></i> Alerta</h5>
                <br>
                <br>
                <p>{{ $message }}</p>
            </div>
            @endif

            <div class="row col-12">
                @foreach($cates as $c)
                <div class="card col-3" style="width: 18rem;">
                    <img class="card-img-top" src="{{ asset('/categories/'.$c->img) }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $c->category }}</h5>
                        <button class="btn btn-primary btn-sm btnEdit" data-target="#modalUpdate" data-toggle="modal" 
                        data-id="{{ $c->id }}" 
                        data-category="{{ $c->category }}">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger btnEliminar" data-id="{{ $c->id }}" data-target="#modalDelete" data-toggle="modal">
                            <i class="fa fa-trash"></i>
                        </button>
                        <form action="{{ url('/admin/categorias',['id'=>$c->id]) }}" method="POST" id="formDelete_{{ $c->id }}">
                            @csrf
                            <input type="hidden" value="{{ $c->id }}" name="id">
                            <input type="hidden" name="_method" value="delete">
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!--Modal -->
        <div class="modal" tabindex="-1" id="modaladd">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/admin/categorias" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text" class="form-control" placeholder="Categoría" name="name"
                                    value="{{ old('name') }}"></input>

                            </div>
                            <div class="form-group">
                                <label for="">Imagen</label>
                                <input type="file" class="form-control" name="img" value="{{ old('img') }}"></input>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Modal delete -->
        <div class="modal" tabindex="-1" role="dialog" id="modalDelete">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Eliminar Registro</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Deseas eliminar el registro?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="doEliminar">Eliminar</button>
                </div>
              </div>
            </div>
        </div>

        <!--Modal Update -->
        <div class="modal" tabindex="-1" id="modalUpdate">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Actualizar Categoria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/admin/categorias/update" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="id" id="idEdit">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input id="nameEdit" type="text" class="form-control" placeholder="Categoría" name="name"
                                    value="{{ old('name') }}"></input>

                            </div>
                            <div class="form-group">
                                <label for="">Imagen</label>
                                <input type="file" class="form-control" name="img" value="{{ old('img') }}"></input>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection

@section('scripts')
        <script>
            var idEliminar=0;
            $(document).ready(function(){
                $('.btnEliminar').click(function(){
                    var id = $(this).data('id');
                    idEliminar = id;
                });
            });
            $("#doEliminar").click(function(){
                $("#formDelete_"+idEliminar).submit();
            });
            $(".btnEdit").click(function(){
                var id = $(this).data('id');
                var cate = $(this).data('category');
                $("#nameEdit").val(cate);
                $("#idEdit").val(id);
            });
        </script>
@endsection