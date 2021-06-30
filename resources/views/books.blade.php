@include('header')
@php
use App\Models\Books;
@endphp
<div class="center">
    <table class="books">
        <tr>
            <th>
                Title
            </th>
            <th>
                ISBN
            </th>
            <th>
                Author
            </th>
            {{-- <th>
                Image
            </th> --}}
        </tr>
        @foreach (Books::all() as $book) 
        
        <tr>
            <td>{{ $book->title }}</td>
            <td>{{ $book->isbn }}</td>
            <td>{{ $book->author }}</td>
        </tr>
        <tr class="imgrow">
            <td class="imgcell" colspan="3">
                <img src='{{ $book->img }}'>
            </td>
        @endforeach
    </table>
</div>

@include('footer')