
@foreach($arraynivelesred as $index => $element)

        <tr>
            <td height="50">Nivel {{ $index+1 }}   </td>
            <td height="50">{{ $element->count()  }}</td>
        </tr>

@endforeach