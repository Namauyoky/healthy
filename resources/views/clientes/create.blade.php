
@extends('master')

@section('htmlheader_title')
    Afiliados
@endsection

@section('contentheader_title')
    Alta
@endsection
@section('contentheader_description')
    Nuevo Afiliado
@endsection

@section('main-content')

    {{--<body class="register-page">--}}
    {{--<div class="register-box">--}}
        {{--@if (count($errors) > 0)--}}
            {{--<div class="alert alert-danger">--}}
                {{--<strong>Uups!</strong>Verifique los Datos ingresados<br><br>--}}
                {{--<ul>--}}
                    {{--@foreach ($errors->all() as $error)--}}
                        {{--<li>{{ $error }}</li>--}}
                    {{--@endforeach--}}
                {{--</ul>--}}
            {{--</div>--}}
        {{--@endif--}}

        {!! Form::open(['class' => 'form']) !!}

            {!! Field::select('pais_id',healthy\Models\Pais::lists('Nombre_Pais','Id_Pais')->toArray()) !!}
            {!! Field::select('estado_id',healthy\Models\Estado::lists('Nombre_Estado','Id_Estado')->toArray()) !!}
            {!! Field::select('ciudad_id',healthy\Models\Ciudad::lists('Nombre_Ciudad','Id_Ciudad')->toArray()) !!}



        {!! Form::close() !!}

        {{--{!! Form::model($makeForm,['method' =>'GET','class' =>'Form','id' => 'search']) !!}--}}
        {{--<div class="register-box-body">--}}
            {{--<p class="login-box-msg">Alta de Cliente</p>--}}
            {{--<form action="{{ route('alta-cliente') }}" method="post">--}}
                {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                {{--<div class="form-group has-feedback">--}}
                    {{--<input type="text" class="form-control" placeholder="Nombre" name="name" value="{{ old('name') }}"/>--}}
                    {{--<span class="glyphicon glyphicon-user form-control-feedback"></span>--}}
                {{--</div>--}}
                {{--<div class="form-group has-feedback">--}}
                    {{--<input type="text" class="form-control" placeholder="Apellidos" name="apellidos" value="{{ old('apellidos') }}"/>--}}
                    {{--<span class="glyphicon glyphicon-envelope form-control-feedback"></span>--}}
                {{--</div>--}}
                {{--<div class="form-group has-feedback">--}}
                    {{--<input type="text" class="form-control" placeholder="Nip" name="nip"/>--}}
                    {{--<span class="glyphicon glyphicon-lock form-control-feedback"></span>--}}
                {{--</div>--}}
                {{--<!-- Date yyyy/mm/dd -->--}}
                {{--<div class="form-group has-feedback">--}}
                        {{--<input type="text" class="form-control" placeholder="Fecha de Nacimiento(1900-01-01)" name="nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" value="{{old('nacimiento')}}"/>--}}
                        {{--<span class="glyphicon glyphicon-calendar form-control-feedback"></span>--}}
                {{--</div>--}}

                {{--<div class="form-group has-feedback">--}}

                 {{--{!! Form::select('Id_Pais',$paises) !!}--}}
                 {{--{!! Form::select('Id_Estado',$paisEstados) !!}--}}
                 {{--{!! Form::select('Id_Ciudad',$ciudades) !!}--}}

                {{--<select class="form-control select2" data-placeholder="Select a State" style="width: 100%;">--}}
                    {{--<option>Alabama</option>--}}
                    {{--<option>Alaska</option>--}}
                    {{--<option>California</option>--}}
                    {{--<option>Delaware</option>--}}
                    {{--<option>Tennessee</option>--}}
                    {{--<option>Texas</option>--}}
                    {{--<option>Washington</option>--}}
                {{--</select>--}}
                 {{--</div>--}}
            {{--</form>--}}
        {{--</div><!-- /.form-box -->--}}
        {{--{{ Form::close() }}--}}
    {{--</div><!-- /.register-box -->--}}
    {{--</body>--}}



@endsection


