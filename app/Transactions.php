<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Organization as Organization;
use App\Customers as Customers;
use App\Projects as Projects;
use App\User as User;

class Transactions extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['project_id', 'amount', 'cost', 'organization_id', 'customers_id', 'type', 'created_by', 'trans_date' ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id'];

    public static function addRecord($data) {

        $userId         = \Auth::user()->id;
        $organizationId = \Auth::user()->organization_id;

        $customerName = $data->organization;
        $customerType = $data->organization_type;
        $customersId  = Customers::getAddCustomer($customerName, $customerType);

        $programName = $data->programme;
        $programId   = Program::getAddProgram($programName, $customersId);

        $projectName = $data->project;
        $projectType = $data->project_type;
        $projectId   = Projects::getAddProject($projectName, $programId, $projectType);


        Transactions::create([
            'project_id'      => $projectId,
            'amount'          => $data->amount,
            'cost'            => $data->cost,
            'organization_id' => $organizationId,
            'customers_id'    => $customersId,
            'type'            => $data->addType,
            'created_by'      => $userId,
            'trans_date'      => strtotime($data->transDateTime),
            'created_at'      => new \DateTime,
            'updated_at'      => new \DateTime
        ]);
    }

}
