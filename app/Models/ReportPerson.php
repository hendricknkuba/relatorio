<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Report;

class ReportPerson extends Model
{
    use HasFactory;

    //protected $table = 'report_people';

    protected $fillable = [
        'report_id',
        'name',
        'is_pioneer',
        'hours',
        'hours_tick',
        'studies',
    ];

    // Relacionamento inverso para o relatório
    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
