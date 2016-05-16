@extends('app')

@section('main-content')


    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <h1>Detalle de Nota</h1>
            <p>
                Categoría:
                @if($note->category)
                    <span class="label label-info">{{$note->category->name}}</span>
                @else
                    <span class="label label-info">Others</span>
                @endif
                | <a href="{{url('notes')}}">View all notes</a>
            </p>
            <hr>
            {{$note->note}}

        </div>

    </div>
@endsection


