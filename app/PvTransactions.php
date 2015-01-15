<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PvTransactions extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'photovoltaic_transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['photovoltaic_id', 'transaction_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public static function addRecord($photovoltaicId, $transactionId)
    {
        try
        {
            $pvTransactions = PvTransactions::create([
                        'photovoltaic_id' => $photovoltaicId,
                        'transaction_id'  => $transactionId
            ]);
            return $pvTransactions;
        }
        catch (Exception $e)
        {
            return FALSE;
        }
    }

}
