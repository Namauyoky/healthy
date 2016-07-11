{{--@if(Session::has('flash_message'))--}}
    {{--<div class="alert alert-success {{ Session::has('flash_message_important') ? 'alert-important' : '' }}">--}}
        {{--@if(Session::has('flash_message_important'))--}}
            {{--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times</button>--}}
        {{--@endif--}}
        {{--{{ session('flash_message') }}--}}
        {{--{{ Session::get('flash_message') }}--}}
    {{--</div>--}}

{{--@endif--}}



    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {{--<h1>Alert</h1>--}}
                {!! Alert::render() !!}
            </div>
        </div>
    </div>
