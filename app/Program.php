<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'program';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'organization_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public static function getPrograms($customerId) {

        $customerId = $customerId ? $customerId : 0;
        $matchThese     = ['customer_id' => $customerId, 'status' => 1];
        $programs       = self::where($matchThese)->get()->toArray();

        return $programs;
    }

    public static function getAddProgram($programName, $customerId) {

        $userId     = \Auth::user()->id;
        $matchThese = ['name' => $programName, 'customer_id' => $customerId, 'status' => 1];
        $program    = self::where($matchThese)->get()->first();

        if ($program)
        {
            $program = $program->toArray();
            return $program['id'];
        } else
        {
            $program              = new Program();
            $program->customer_id = $customerId;
            $program->name        = $programName;
            $program->created_by  = $userId;
            $program->created_at  = new \DateTime;
            $program->updated_at  = new \DateTime;
            $program->save();

            return $program->id;
        }
    }

}
