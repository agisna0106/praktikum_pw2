<?php

namespace App\Http\Controllers;

use App\Exports\BukuExport;
use App\Imports\BooksImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function exportBook()
    {
        return Excel::download(new BukuExport, 'books.xlsx');
    }

    public function import(Request $request){
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);
        Excel::import(new BooksImport(), $request->file('file'));
        return redirect(route('books'));
    }
    
}
