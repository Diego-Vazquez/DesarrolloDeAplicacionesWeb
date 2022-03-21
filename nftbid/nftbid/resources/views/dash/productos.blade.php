@extends('dash.index')
@section('contenido')

<!-- Page Heading -->
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Productos</h1>
                <a href="#" data-toggle="modal" data-target = "#modaladd" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i>Agregar Producto</a>
            </div>
        </div>

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
                @foreach($nfts as $nft)
                <div class="card col-3" style="width: 18rem;">
                    <img class="card-img-top" src="{{ asset('/nfts/'.$nft->img) }}" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title">{{ $nft->name }}</h5>
                      <p class="card-text">{{ $nft->description }}</p>
                      <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                  </div>
                @endforeach
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


        <!--Modal -->

<div class="modal" tabindex="-1" id="modaladd">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
            <form action="/admin/productos" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class ="form-group">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control" placeholder="NombreProducto" name="name" value="{{ old('name') }}"></input>
                
                    </div>
                    <div class ="form-group">
                        <label for="">Descripción</label>
                        <input type="text" class="form-control" placeholder="Descripcion" name="description" value="{{ old('description') }}"></input>
                    
                    </div>
                    <div class ="form-group">
                        <label for="">Precio base</label>
                        <input type="number" class="form-control" placeholder="Precio base" name="price" value="{{ old('price') }}"></input>
                    
                    </div>
                    <div class ="form-group">
                        <label for="">Imagen</label>
                        <input type="file" class="form-control" name="img" value="{{ old('img') }}"></input>
                    
                    </div>
                    <div class ="form-group">
                        <label>Blockchain</label>
                        <select name="btype" id="" class="form-control" value="{{ old('btype') }}">
                            <option value="Etherium">Etherium</option>
                            <option value="Polygon">Polygon</option>                   
                        </select>
                    </div>
                    <div class ="form-group">
                        <label>Categoria</label>
                        <select name="cate" id="" class="form-control" value="{{ old('cate') }}">
                            @foreach($categorias as $cate)
                                 <option value="{{$cate->id}}">{{$cate->category}}</option>
                            @endforeach
                        </select>
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