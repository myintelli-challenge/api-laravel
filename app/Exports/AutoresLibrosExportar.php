<?php

namespace App\Exports;

use App\Autores;
use App\Libros;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AutoresLibrosExportar implements WithMultipleSheets{
    public function sheets(): array{
        return [
            new AutoresSheet(),
            new LibrosSheet()
        ];
    }
}

class AutoresSheet implements FromCollection, WithHeadings, WithTitle{
    public function collection(){
        return Autores::select('id', 'nombre', 'apellido', 'telefono', 'cantidad_libros')->get();
    }

    public function headings(): array{
        return ['ID', 'Nombre', 'Apellido', 'Teléfono', 'Cantidad libros'];
    }

    public function title(): string{
        return 'Autores';
    }
}

class LibrosSheet implements FromCollection, WithHeadings, WithTitle{
    public function collection(){
        return Libros::select('id', 'titulo', 'descripcion', 'anio_publicacion', 'autores_id')->get();
    }

    public function headings(): array{
        return ['ID', 'Titulo', 'Descripción', 'Año publicación', 'ID Autor'];
    }

    public function title(): string{
        return 'Libros';
    }
}