<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Chanel extends Model
{
    use HasAdvancedFilter, SoftDeletes, HasFactory;

    public $table = 'chanels';

    protected $appends = [
        'type_label',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $filterable = [
        'id',
        'name',
        'chanelurl',
        'user.name',
        'description',
        'type',
    ];

    protected $orderable = [
        'id',
        'name',
        'chanelurl',
        'status',
        'user.name',
        'description',
        'type',
    ];

    protected $fillable = [
        'name',
        'chanelurl',
        'status',
        'user_id',
        'description',
        'type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const TYPE_SELECT = [
        [
            'label' => 'Sales',
            'value' => 'sales',
        ],
        [
            'label' => 'HR',
            'value' => 'hr',
        ],
        [
            'label' => 'Sales outstaff',
            'value' => 'salesoutstaff',
        ],
        [
            'label' => 'Sales outsorce',
            'value' => 'salesoutsorce',
        ],
        [
            'label' => 'Remote',
            'value' => 'remote',
        ],
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTypeLabelAttribute()
    {
        return collect(static::TYPE_SELECT)->firstWhere('value', $this->type)['label'] ?? '';
    }
}
