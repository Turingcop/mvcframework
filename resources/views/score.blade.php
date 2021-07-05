@include('header')

<div class="center">
    <table class="scoretable">
        <tr>
            <th>Placering</th>
            <th>Poäng</th>
            <th>Namn</th>
            <th>Tidpunkt</th>
        </tr>
    @php $counter = 1 @endphp
    @foreach ($score as $row)
        <tr>
        <td>{{ $counter }}</td>
        @php $counter += 1 @endphp
        <td>{{ $row->score }}</td>
        <td>{{ $row->name ?? 'Okänd' }}</td>
        <td>{{ $row->created_at }}</td>
        </tr>
    @endforeach
    </table>
</div>

@include('footer')