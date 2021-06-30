@include('header')

<div class="center">
    <table>
    @foreach ($score as $row)
        <tr>
        <td>{{ $row->score }}</td>
        <td>{{ $row->created_at}}</td>
        </tr>
    @endforeach
    </table>
</div>

@include('footer')