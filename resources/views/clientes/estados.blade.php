@extends('master')

@section('main-content')

    {!! Form::select('estados',$states) !!}

    {!! Form::select('ciudades') !!}


@endsection

