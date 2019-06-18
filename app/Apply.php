<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{


    // define the table to use
    protected $table = 'applications';

    // define the mass assignable fields
    protected $fillable = [
        'firstname', 'lastname', 'email', 'experience', 'availability',
        'message', 'resume', 'job_id', 'user_id'
    ];

    /**
     * An application belongs to a particular job
     *
     * @return Illuminate\Database\Eloquent\Relationships;
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
