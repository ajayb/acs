<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'organization';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id'];

    public function getAll()
    {

        $results = Organization::orderBy('name')->get();
        return $results;
    }

}
