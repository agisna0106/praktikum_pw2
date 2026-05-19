<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BukuExport implements FromArray, WithHeadings, ShouldAutoSize
{
    public function array(): array{
        return Book::getBooks();
    }

    public function headings(): array{
        return [
            'No',
            'Title',
            'Author',
            'Year',
            'Publisher',
            'Kota',
        ];
    }
}
