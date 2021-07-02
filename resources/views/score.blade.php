@include('header')

<div class="center">
    <table class="scoretable">
        <tr>
            <th>Poäng</th>
            <th>Namn</th>
            <th>Tidpunkt</th>
        </tr>
    @foreach ($score as $row)
        <tr>
        <td>{{ $row->score }}</td>
        <td>{{ $row->name ?? 'Okänd' }}</td>
        <td>{{ $row->created_at }}</td>
        </tr>
    @endforeach
    </table>
</div>

@include('footer')