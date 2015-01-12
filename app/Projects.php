<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'projects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'program_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    
    public static function getProjects($programId) {
        
        $programId = $programId ? $programId : 0;
        $matchThese     = ['program_id' => $programId, 'status' => 1];
        $projects       = self::where($matchThese)->get()->toArray();
        
        return $projects;
    }
    

    public static function getAddProject($projectName, $programId, $projectType) {

        $userId         = \Auth::user()->id;
        $organizationId = \Auth::user()->organization_id;
        $matchThese     = ['name' => $projectName, 'program_id' => $programId, 'status' => 1];
        $project        = self::where($matchThese)->get()->first();

        if ($project)
        {
            $project = $project->toArray();
            return $project['id'];
        } else
        {
            $project             = new Projects();
            $project->program_id = $programId;
            $project->name       = $projectName;
            $project->type       = $projectType;
            $project->created_by = $userId;
            $project->created_at = new \DateTime;
            $project->updated_at = new \DateTime;
            $project->save();

            return $project->id;
        }
    }

}
