<?php

namespace App\Http\Controllers;

use App\Exports\BukuExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function exportBook()
    {
        return Excel::download(new BukuExport, 'books.xlsx');
    }
}
