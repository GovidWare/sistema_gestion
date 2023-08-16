<?php

namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class TasksExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Task::select(
            'users.name', 'tasks.title',
            'tasks.description',
            DB::raw('CASE
                         WHEN tasks.status = "HA" THEN "Por hacer"
                         WHEN tasks.status = "PR" THEN "En Progreso"
                         WHEN tasks.status = "CO" THEN "Completado"
                         ELSE "Desconocido"
                     END as status_label'),

            'tasks.start_date', 'tasks.end_date'
        )
        ->addUser()
        ->orderBy('tasks.id','DESC')
        ->get();
    }

    public function headings(): array
    {
        return [
            'Usuario',
            'Título',
            'Descripción',
            'Estado',
            'Fecha inicio',
            'Fecha Fin',
        ];
    }
}
