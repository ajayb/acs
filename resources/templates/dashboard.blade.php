@extends('app')
@section('title')
@parent
@stop

@section('content')

<div id="mainTab"  class="row">
    <div class="col-md-12"> 
        <div class="bs-example bs-example-tabs">
            <ul id="carbonTabs" class="nav nav-tabs">
                <li class="active"><a href="#brokered_carbon" data-url="/dashboard/brokered" data-toggle="tab" aria-expanded="true">Brokered Carbon</a></li>
                <li><a href="#donated_carbon" data-url="/dashboard/donated" data-toggle="tab">Donated Carbon</a></li>
                <li><a href="#member" data-url="/dashboard/member" data-toggle="tab">Users</a></li>
                <li><a href="#org_stats" data-url="/dashboard/organizationData" data-toggle="tab">Organization</a></li>
            </ul>    
            <div  class="tab-content">
                <div  class="tab-pane active" id="brokered_carbon"></div>
                <div  class="tab-pane" id="donated_carbon"></div>  
                <div  class="tab-pane" id="member"></div>  
                <div  class="tab-pane" id="org_stats"></div>  
            </div>
        </div>
    </div>
</div>
@stop