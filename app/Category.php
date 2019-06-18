<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * A category has many jobs
     *
     * @return \Illuminate\Database\Eloquent\Relationship
     */
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
