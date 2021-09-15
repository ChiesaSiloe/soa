<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

use App\Models\Service;

class Member extends Model
{
    use HasFactory, AsSource, Filterable, Attachable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'fiscal_code',
        'phone_number',
        'birth_date',
        'birth_place',
        'city',
        'address',
        'civic_number'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'birth_date'    => 'datetime',
    ];

    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getDisplayNameAttribute()
    {
        return "{$this->name} {$this->surname}";;
    }

    /**
     * Get the services for the member.
     */
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
