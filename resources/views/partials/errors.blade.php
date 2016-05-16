@if(! $errors->isEmpty())
    <div class="alert alert-danger">

        <p><strong>Upps!</strong>Revise los errores siguientes</p>
        <ul>
            @foreach($errors->all() as $error)
                <li>
                    {{ $error }}
                </li>
            @endforeach
        </ul>

    </div>
@endif