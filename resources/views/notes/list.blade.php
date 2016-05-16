@extends('app')

@section('main-content')
    <h1>Notes</h1>
    <p>
        <a href="{{ url('notes/create') }}">Add a note</a>
    </p>
    <ul class="list-group">
        @foreach($notes as $note)
            <li class="list-group-item">
                @if($note->category)
                    <span class="label label-info">{{ $note->category->name }}</span>
                @else
                    <span class="label label-info">Others</span>
                @endif
                    {{--{{ $note ->note }}--}}
                    {{substr($note->note,0,100)}}...
                    <a href="{{ url('notes/'.$note->id) }}" class="small">View note</a>
            </li>
        @endforeach
    </ul>
    {!!  $notes->render() !!}
@endsection
