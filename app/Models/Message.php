<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Message extends Model
{
    use HasAdvancedFilter, SoftDeletes, HasFactory;

    public $table = 'messages';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $orderable = [
        'id',
        'chanel.chanelurl',
        'title',
        'text',
        'contactt',
        'contacts',
    ];

    protected $filterable = [
        'id',
        'chanel.chanelurl',
        'title',
        'text',
        'contactt',
        'contacts',
        'tag.tag',
    ];

    protected $fillable = [
        'chanel_id',
        'title',
        'text',
        'contactt',
        'contacts',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function chanel()
    {
        return $this->belongsTo(Chanel::class);
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class);
    }
}
