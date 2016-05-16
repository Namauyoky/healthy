@if(Session::has('alert'))
    <p class="alert-success">

        {{ Session::get('alert') }}

    </p>

@endif