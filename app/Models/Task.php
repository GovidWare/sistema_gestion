<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Carbon\CarbonInterface;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function getTimeRemainingAttribute()
    {
        $startDate = Carbon::parse($this->start_date);
        $now = Carbon::now();

        if ($startDate->isToday()) {
            return "La tarea comienza hoy.";
        } elseif ($startDate->lte($now)) {
            return "La tarea ha comenzado.";
        } else {
            return $now->diffForHumans($startDate, [
                'syntax' => CarbonInterface::DIFF_ABSOLUTE,
                'parts' => 3,
            ]);
        }
    }

    public function getTimeCompletionAttribute()
    {
        $endDate = Carbon::parse($this->end_date);
        $now = Carbon::now();

        if ($now->isSameDay($endDate)) {
            return 'La tarea terminó hoy.';
        } elseif ($now->gt($endDate)) {
            return $endDate->diffForHumans($now, [
                'syntax' => CarbonInterface::DIFF_ABSOLUTE,
                'parts' => 3,
            ]);
        } else {
            return 'La tarea aún no ha terminado.';
        }
    }

}
