<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customers;
use App\Program;
use App\Projects;
use App\Transactions;

class DashboardController extends Controller {

    public function __construct()
    {      
       $this->middleware('acsauth');       
    }

    public function index()
    {
        $this->title = "Dashboard";                
        return view('dashboard', compact('title'));
    }
    
    public function brokered()
    {
        $this->title = "Brokered Carbon";                
        return view('acs/brokered', compact('title'));
    }
    
    public function donated()
    {
        $this->title = "Donated Carbon";                
        return view('acs/donated', compact('title'));
    }
    
    public function buy()
    {
        $this->title = "Buy Carbon";                
        return view('acs/buy', compact('title'));
    }
    
    public function addTransactions(Request $request)
    {        
        $this->title = "Add Buy Carbon";                   
        Transactions::addRecord($request);
    }
    
    public function sell()
    {
        $this->title = "Sell Carbon";                
        return view('acs/sell', compact('title'));
    }
    
    public function transfer()
    {
        $this->title = "Transfer Carbon";                
        return view('acs/transfer', compact('title'));
    }
    
    public function grant()
    {
        $this->title = "Grant Carbon";                
        return view('acs/grant', compact('title'));
    }
    
    public function park()
    {
        $this->title = "Park Carbon";                
        return view('acs/park', compact('title'));
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
    
    public function inputdata()
    {
        $organization[1]['name'] = 'ajay';
        $organization[1]['nonProfit'] = '1';
        $organization[1]['individual'] = '1';
        $organization[1]['id'] = '1';
        
        $organization[2]['name'] = 'ajay2';
        $organization[2]['nonProfit'] = '0';
        $organization[2]['individual'] = '1';
        $organization[2]['id'] = '2';
        
        $organization[3]['name'] = 'ajay3';
        $organization[3]['nonProfit'] = '0';
        $organization[3]['individual'] = '0';
        $organization[3]['id'] = '3';
        
        return $organization;
    }
   

}
