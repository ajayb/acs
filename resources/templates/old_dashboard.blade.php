@extends('app')
@section('title')
@parent
@stop

@section('content')
<div>
    <a data-toggle="modal" class="btn btn-info clsClear" href="/dashboard/buy" data-target="#acsModal" >Buy</a>
    <a data-toggle="modal" class="btn btn-info clsClear" href="/dashboard/sell" data-target="#acsModal">Sell</a>
    <a data-toggle="modal" class="btn btn-info clsClear" href="/dashboard/transfer" data-target="#acsModal">Transfer</a>
    <a data-toggle="modal" class="btn btn-info clsClear" href="/dashboard/grant" data-target="#acsModal">Grant</a>
    <a data-toggle="modal" class="btn btn-info clsClear" href="/dashboard/park" data-target="#acsModal">Park</a>  
</div>
<br/>
<div class="container-fluid">
  <ul class="nav nav-tabs" id="carbonTabs">
    <li class="active"><a href="#brokered_carbon" data-url="/dashboard/brokered">Brokered Carbon</a></li>
    <li><a href="#donated_carbon" data-url="/dashboard/donated">Donated Carbon</a></li>    
  </ul>
  
  <div class="tab-content">
    <div class="tab-pane active" id="brokered_carbon"></div>
    <div class="tab-pane" id="donated_carbon"></div>    
  </div>
</div>


<div class="modal fade" id="acsModal" tabindex="-1" role="dialog" aria-labelledby="AcsCarbon" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>   
</div>

@if( Auth::check() )
Current user: {{ Auth::user()->email }}

Current user: {{ Session::get('assignedRoles')[2] }}
@endif

@stop