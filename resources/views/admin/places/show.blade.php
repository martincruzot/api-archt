@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <section class="panel panel-info">
                <div class="panel-heading">
                    {{ $place->name }}
                </div>
                <div class="panel-body">

                    <div class="box-info">
                        <h4 class="text-primary">Categoría</h4>
                        <p >{{ $place->category->name }}</p>
                    </div>
                    <div class="box-info">
                        <h4 class="text-primary">Latitud</h4>
                        <p>{{ $place->lat }}</p>
                    </div>
                    <div class="box-info">
                        <h4 class="text-primary">Longitud</h4>
                        <p>{{ $place->lng }}</p>
                    </div>
                    <div class="box-info">
                        <h4 class="text-primary">Elevación</h4>
                        <p>{{ $place->elevation }}</p>
                    </div>
                    <div class="box-info">
                        <h4 class="text-primary">Sitio Web</h4>
                        <p><a class="text-info" href="{{ $place->webpage }}">{{ $place->webpage }}</a></p>
                    </div>
                    <div class="box-info">
                        <h4 class="text-primary">Descripción</h4>
                        <p>{{ $place->description }}</p>
                    </div>

                    <form id="addPhotosForm" action="{{ route('admin.place.photos', $place->id) }}"  method="POST" class="dropzone">
                        {{ csrf_field() }}
                    </form>
                </div>
            </section>
        </div>

        <section class="col-md-6 gallery">
            @foreach($place->photos->chunk(3) as $set)
                <div class="row">
                    @foreach($set as $photo)
                        <div class="col-md-4">
                            <form method="POST" action="/admin/photos/{{ $photo->id }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"> Eliminar</i></button>
                            </form>
                            
                            <a href="/{{ $photo->path }}" data-lity>
                                <img src="/{{ $photo->thumbnail_path }}" alt="">
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </section>
    </div>


@stop

@section('css-content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css" />

    <style>
        img {  max-width: 100%; margin-bottom: 1em;}
        .box-info {margin-bottom: 1.5em;}
    </style>
@stop

@section('js-content')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
    <script src="{{ asset('js/places.show.js') }}"></script>
@stop