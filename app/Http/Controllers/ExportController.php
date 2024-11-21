<?php

namespace App\Http\Controllers;

use App\Exports\AutoresLibrosExportar;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export()
    {
        $fileName = 'autores_y_libros.xlsx';
        return Excel::download(new AutoresLibrosExportar, $fileName);
    }
}