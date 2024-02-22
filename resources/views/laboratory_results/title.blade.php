<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Parent</th>
    </tr>
    </thead>
    <tbody>
    @foreach($indicators as $indicator)
        <tr>
            <td>{{ $indicator->id }}</td>
            <td>{{ $indicator->name }}</td>
            <td>
                @if($indicator->parent)
                    {{ $indicator->parent->name }}
                @else
                    N/A
                @endif
            </td>
        </tr>
        @if(count($indicator->childs))
            @include('laboratory_results.title', ['indicators' => $indicator->childs])
        @endif
    @endforeach
    </tbody>
</table>

