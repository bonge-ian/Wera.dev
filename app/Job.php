<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'title', 'company', 'category_id', 'user_id', 'contact_name', 'contact_email',
        'summary', 'description'
    ];
    
    /**
     * A job belongs to a category
     *
     * @return \Illuminate\Database\Eloquent\Relationship
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * A job belongs to a user
     *
     * @return \Illuminate\Database\Eloquent\Relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A job has many applications
     *
     * @return \Illuminate\Database\Eloquent\Relationship
     */
    public function applications()
    {
        return $this->hasMany(Apply::class);
    }
}
