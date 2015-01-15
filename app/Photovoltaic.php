<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Organization as Organization;
use App\Customers as Customers;
use App\Projects as Projects;
use App\User as User;

class Photovoltaic extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'photovoltaic';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['project_id', 'organization_id', 'serial_number', 'kw_reading', 'carbon', 'reading_time', 'amount', 'cost', 'created_by'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public static function addRecord($data)
    {
        try
        {
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


            $photovoltaic = Photovoltaic::create([
                        'project_id'      => $projectId,
                        'organization_id' => $organizationId,
                        'serial_number'   => $data->serialNumber,
                        'kw_reading'      => str_replace(',', '', $data->kwReading),
                        'carbon'          =>  str_replace(',', '', $data->carbon),
                        'reading_time'    => strtotime($data->transDateTime),
                        'created_by'      => $userId,
                        'created_at'      => new \DateTime,
                        'updated_at'      => new \DateTime
            ]);
            return $photovoltaic;
        }
        catch (Exception $e)
        {
            return FALSE;
        }
    }

    public static function getPvRecords()
    {
        try
        {
            $userId         = \Auth::user()->id;
            $organizationId = \Auth::user()->organization_id;

            $pvRecords = self::selectRaw("photovoltaic.id, photovoltaic.serial_number, photovoltaic.kw_reading, photovoltaic.carbon, photovoltaic.reading_time, 
                    trans.id, trans.project_id, trans.amount, trans.cost,
                    cust.id, cust.name as custname, 
                    prj.id, prj.name as prjname, prj.program_id,
                    prog.id, prog.name as progname")
                    ->join('photovoltaic_transactions as pvTrans', 'pvTrans.photovoltaic_id', '=', 'photovoltaic.id')
                    ->join('transactions as trans', 'trans.id', '=', 'pvTrans.transaction_id')
                    ->join('customers as cust', 'cust.id', '=', 'trans.customers_id')                    
                    ->join('projects as prj', 'prj.id', '=', 'trans.project_id')
                    ->join('program as prog', 'prog.id', '=', 'prj.program_id')
                    ->where('photovoltaic.organization_id', '=', $organizationId)
                    ->orderBy('photovoltaic.reading_time', 'DESC')
                    ->get()
                    ->toArray();
            
           //echo '<pre>'; print_r($pvRecords); echo '</pre>';
            return $pvRecords;
        }
        catch (Exception $ex)
        {
            return FALSE;
        }
    }

}
