<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Customers;
use App\Program;
use App\Projects;
use App\Transactions;
use App\Photovoltaic;
use App\PvTransactions;

class DashboardController extends Controller {

    public function __construct()
    {
        $this->middleware('acsauth');
        $this->projectType      = Config::get('acs.projectType');
        $this->organizationType = Config::get('acs.organizationType');
        $this->metricValue      = Config::get('acs.metricValue');
    }

    public function index()
    {
        $title = "Dashboard";
        return view('dashboard', compact('title'));
    }

    public function brokered()
    {
        $title = "Brokered Carbon";
        return view('acs/brokered', compact('title'));
    }

    public function donated()
    {
        $title = "Donated Carbon";
        return view('acs/donated', compact('title'));
    }

    public function member()
    {
        $title = "ACS Members";
        return view('acs/member', compact('title'));
    }

    public function stats()
    {
        $title = "Organization Stats";
        return view('acs/stats', compact('title'));
    }

    public function buy()
    {
        $title            = "Buy Carbon";
        $projectType      = $this->projectType;
        $organizationType = $this->organizationType;
        return view('acs/buy', compact('title', 'projectType', 'organizationType'));
    }

    public function addTransactions(Request $request)
    {
        $title               = "Add Buy Carbon";
        $result              = Transactions::addRecord($request);
        $response['success'] = $result;
        return json_encode($response);
    }

    public function sell()
    {
        $title            = "Sell Carbon";
        $projectType      = $this->projectType;
        $organizationType = $this->organizationType;
        return view('acs/sell', compact('title', 'projectType', 'organizationType'));
    }

    public function transfer()
    {
        $title            = "Transfer Carbon";
        $projectType      = $this->projectType;
        $organizationType = $this->organizationType;
        return view('acs/transfer', compact('title', 'projectType', 'organizationType'));
    }

    public function grant()
    {
        $title            = "Grant Carbon";
        $projectType      = $this->projectType;
        $organizationType = $this->organizationType;
        return view('acs/grant', compact('title', 'projectType', 'organizationType'));
    }

    public function park()
    {
        $title            = "Park Carbon";
        $projectType      = $this->projectType;
        $organizationType = $this->organizationType;
        return view('acs/park', compact('title', 'projectType', 'organizationType'));
    }

    public function pvdata()
    {
        $title            = "PV Data";
        $projectType      = $this->projectType;
        $organizationType = $this->organizationType;
        return view('acs/pvdata', compact('title', 'projectType', 'organizationType'));
    }

    public function pvDataGrid()
    {
        $title     = "PV Data";
        $pvRecords = Photovoltaic::getPvRecords();
        $metricValue = $this->metricValue;
        return view('acs/pvDataGrid', compact('title', 'pvRecords', 'metricValue'));
    }

    public function addPvData(Request $request)
    {
        $title    = "Add PV Data";
        $pvResult = Photovoltaic::addRecord($request);

        $request->addType = 'brokered';
        $request->amount  = ($request->carbon * 0.00045359);
        $transResult      = Transactions::addRecord($request);

        echo $pvResult->id;
        echo $transResult->id;
        $result = PvTransactions::addRecord($pvResult->id, $transResult->id);

        $response['success'] = $result;
        return json_encode($response);
    }

    public function organization()
    {
        $organization = Customers::getCustomers();
        return json_encode($organization);
    }

    public function programme(Request $request)
    {
        $programme = Program::getPrograms($request->id);
        return json_encode($programme);
    }

    public function project(Request $request)
    {
        $project = Projects::getProjects($request->id);
        return json_encode($project);
    }
    
    public function carbonCredit()
    {
        $organizationId = \Auth::user()->organization_id;
        $carbonCredit = Transactions::getCarbonCredit($organizationId);
        $ccDetails = ['availableCC' => $carbonCredit];
        return json_encode($ccDetails);
    }
    
    public function organizationData()
    {
        $title            = "Organization";        
        return view('acs/organizationData', compact('title'));
    }
    
    public function orgData()
    {
        $title            = "Organization";        
        return view('acs/orgData', compact('title'));
    }

    public function organizationDataGrid()
    {
        $title     = "Organization Data";
        $orgRecords = array();// Organization::getOrgRecords();        
        return view('acs/organizationDataGrid', compact('title', 'orgRecords'));
    }

    public function addOrganization(Request $request)
    {
        $title    = "Add Organization Data";
        $orgResult = Organization::addRecord($request);        
        return json_encode($orgResult);
    }    

}