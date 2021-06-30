<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Models\Books;

class BookController extends BaseController
{
    public function show()
    {
        foreach (Books::all() as $book) {
            echo $book->title;
        }
    }
}
