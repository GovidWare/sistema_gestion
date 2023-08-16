<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        truncate('tasks');

        Task::insert([
            [
                'user_id'     => 1,
                'title'       => 'Tarea 1',
                'description' => 'Descripción de la tarea 1',
                'status'      => 'CO',
                'start_date'  => '2023-05-05',
                'end_date'    => '2023-05-05',
                'file'        => null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'user_id'     => 1,
                'title'       => 'Tarea 2',
                'description' => 'Descripción de la tarea 2',
                'status'      => 'PR',
                'start_date'  => '2023-08-20',
                'end_date'    => '2023-08-30',
                'file'        => null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'user_id'     => 1,
                'title'       => 'Tarea 3',
                'description' => 'Descripción de la tarea 3',
                'status'      => 'HA',
                'start_date'  => '2023-08-18',
                'end_date'    => '2023-09-10',
                'file'        => null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'user_id'     => 2,
                'title'       => 'Tarea 1',
                'description' => 'Descripción de la tarea 1',
                'status'      => 'CO',
                'start_date'  => '2023-06-03',
                'end_date'    => '2023-06-05',
                'file'        => null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'user_id'     => 2,
                'title'       => 'Tarea 2',
                'description' => 'Descripción de la tarea 2',
                'status'      => 'PR',
                'start_date'  => '2023-08-19',
                'end_date'    => '2023-08-25',
                'file'        => null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'user_id'     => 2,
                'title'       => 'Tarea 3',
                'description' => 'Descripción de la tarea 3',
                'status'      => 'HA',
                'start_date'  => '2023-08-16',
                'end_date'    => '2023-09-18',
                'file'        => null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'user_id'     => 3,
                'title'       => 'Tarea 1',
                'description' => 'Descripción de la tarea 1',
                'status'      => 'CO',
                'start_date'  => '2023-08-05',
                'end_date'    => '2023-08-09',
                'file'        => null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'user_id'     => 3,
                'title'       => 'Tarea 2',
                'description' => 'Descripción de la tarea 2',
                'status'      => 'PR',
                'start_date'  => '2023-08-19',
                'end_date'    => '2023-08-26',
                'file'        => null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'user_id'     => 3,
                'title'       => 'Tarea 3',
                'description' => 'Descripción de la tarea 3',
                'status'      => 'HA',
                'start_date'  => '2023-08-17',
                'end_date'    => '2023-09-11',
                'file'        => null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
