<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;

class BooksImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Book([
            'id'    => $row[0],
            'name'     => $row[1],
            'author'    => $row[2],
            'publisher' => $row[3],
            'year'     => $row[4],
            'isbn'    => $row[5],
            'type'     => $row[6],
        ]);
    }
}
