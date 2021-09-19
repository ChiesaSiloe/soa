<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

use App\Models\Member;

class Service extends Model
{
    use HasFactory, AsSource, Filterable, Attachable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'attended_on',
        'member_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'attended_on'    => 'datetime',
    ];

    protected $allowedSorts = [
        'attended_on',
    ];

    protected $allowedFilters = [
        'attended_on',
    ];

    /**
     * Get the member that attended the service.
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
