<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Job;

class User extends Model
{
    use Notifiable, HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';

    protected $fillable = [
        'name',
        'id_job',
        'email',
        'active',
        'scheduled_resignation',
        'deleted_at'
    ];

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }
}
