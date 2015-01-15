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
    protected $fillable = ['project_id', 'amount', 'cost', 'organization_id', 'customers_id', 'type', 'created_by', 'trans_date'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id'];

    public static function addRecord($data)
    {
        try
        {
            $userId         = \Auth::user()->id;
            $organizationId = \Auth::user()->organization_id;

            $isNonProfit = $data->addType == 'grant' ? 1 : 0;

            $customerName = $data->organization;
            $customerType = $data->organization_type;
            $customersId  = Customers::getAddCustomer($customerName, $customerType, $isNonProfit);

            $programName = $data->programme;
            $programId   = Program::getAddProgram($programName, $customersId);

            $projectName = $data->project;
            $projectType = $data->project_type;
            $projectId   = Projects::getAddProject($projectName, $programId, $projectType);


            $transactions = Transactions::create([
                        'project_id'      => $projectId,
                        'amount'          => str_replace(',', '', $data->amount),
                        'cost'            => str_replace(',', '', $data->cost),
                        'organization_id' => $organizationId,
                        'customers_id'    => $customersId,
                        'type'            => $data->addType,
                        'created_by'      => $userId,
                        'trans_date'      => strtotime($data->transDateTime),
                        'created_at'      => new \DateTime,
                        'updated_at'      => new \DateTime
            ]);
            return $transactions;
        }
        catch (Exception $e)
        {
            return FALSE;
        }
    }

    public static function getCarbonCredit($organizationId)
    {
        $totalCC = 0;

        $gainType = ['buy', 'park', 'donated', 'brokered'];
        $lossType = ['sell', 'transfer', 'grant'];

        try
        {
            $gain       = self::selectRaw("sum(amount) as gainCC")
                    ->where('organization_id', '=', $organizationId)
                    ->whereIn('type', $gainType)
                    ->groupBy('organization_id');
            $gainResult = $gain->get()->toArray();
            $totalGain  = $gainResult[0]['gainCC'];

            $loss       = self::selectRaw("sum(amount) as lossCC")
                    ->where('organization_id', '=', $organizationId)
                    ->whereIn('type', $lossType)
                    ->groupBy('organization_id');
            $lossResult = $loss->get()->toArray();
            $totalLoss  = $lossResult[0]['lossCC'];

            //echo $gain->toSql();
            $totalCC = $totalGain - $totalLoss;
            $totalCC = number_format($totalCC, 2, '.', ',');
            return $totalCC;
        }
        catch (Exception $e)
        {
            return 'N/A';
        }
    }

}
