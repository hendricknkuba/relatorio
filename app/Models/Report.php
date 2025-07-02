<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReportPerson;
use App\Models\User;

class Report extends Model
{
    use HasFactory;

    //protected $table = 'reports';

    protected $fillable = [
        'user_id',
        'month',
        'author_name',
        'is_pioneer',
        'hours',
        'hours_tick',
        'studies',
        'additional_info',
    ];

    // Relacionamento com usuário (quem criou o relatório)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacionamento 1:N com pessoas associadas
    public function people()
    {
        return $this->hasMany(ReportPerson::class);
    }
}
