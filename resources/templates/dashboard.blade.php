@extends('app')
@section('title')
@parent
@stop

@section('content')
<div>
    <a data-toggle="modal" class="btn btn-info" href="/dashboard/buy" data-target="#buyModal">Buy</a>
    <a data-toggle="modal" class="btn btn-info" href="/dashboard/sell" data-target="#sellModal">Sell</a>
    <a data-toggle="modal" class="btn btn-info" href="/dashboard/transfer" data-target="#transferModal">Transfer</a>
    <a data-toggle="modal" class="btn btn-info" href="/dashboard/grant" data-target="#grantModal">Grant</a>
    <a data-toggle="modal" class="btn btn-info" href="/dashboard/park" data-target="#parkModal">Park</a>  
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


<div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="BuyCarbon" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>   
</div>
<div class="modal fade" id="sellModal" tabindex="-1" role="dialog" aria-labelledby="SellCarbon" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>   
</div>
<div class="modal fade" id="transferModal" tabindex="-1" role="dialog" aria-labelledby="TransferCarbon" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>   
</div>
<div class="modal fade" id="grantModal" tabindex="-1" role="dialog" aria-labelledby="GrantCarbon" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>   
</div>
<div class="modal fade" id="parkModal" tabindex="-1" role="dialog" aria-labelledby="ParkCarbon" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>   
</div>

@if( Auth::check() )
Current user: {{ Auth::user()->email }}

Current user: {{ Session::get('assignedRoles')[2] }}
@endif

@stop