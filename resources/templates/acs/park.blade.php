<form class="form-horizontal fv-form fv-form-bootstrap" method="post" name="parkCarbonForm" id="parkCarbonForm" >   
    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
    <input type="hidden" id="addType" name="addType" value="park">
    <div class="modal-header">
        <button type="button" class="close cancel" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title" id="simpleModalLabel">Park</h4>
    </div>
    <div class="modal-body">
        <form class="form-horizontal form-bordered form-banded" role="form">
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-md-4 col-sm-3">
                            <label for="organization" class="control-label">Organization</label>
                        </div>
                        <div class="col-md-8 col-sm-9">                            
                            <input type="text" name="organization" id="organization" class="form-control" autocomplete="off" placeholder="Organization">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-9">
                            <select name="organization_type" id="organization_type" class="form-control">
                                @foreach($organizationType as $key => $val)
                                    <option value="{{$key}}">{{$val}}</option>                                
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-md-4 col-sm-3">
                            <label for="programme" class="control-label">Program</label>
                        </div>
                        <div class="col-md-8 col-sm-9">                            
                            <input type="text" name="programme" id="programme" class="form-control" autocomplete="off" placeholder="Program">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4"> </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-md-4 col-sm-3">
                            <label for="project" class="control-label">Project</label>
                        </div>
                        <div class="col-md-8 col-sm-9">                            
                            <input type="text" name="project" id="project" class="form-control" autocomplete="off" placeholder="Project"> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-9">
                            <select name="project_type" id="project_type" class="form-control">
                                @foreach($projectType as $key => $val)
                                    <option value="{{$key}}">{{$val}}</option>                                
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-md-4 col-sm-3">
                            <label for="amount" class="control-label">Amount (#)</label>
                        </div>
                        <div class="col-md-8 col-sm-9">                            
                            <input type="text" name="amount" id="amount" class="form-control" autocomplete="off" placeholder="Total Carbon in Metric Tonnes"> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-4"> </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-md-4 col-sm-3">
                            <label for="cost" class="control-label">Cost ($)</label>
                        </div>
                        <div class="col-md-8 col-sm-9">                            
                            <input type="text" name="cost" id="cost"  class="form-control" autocomplete="off" placeholder="Cost">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4"> </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-md-4 col-sm-3">
                            <label for="transDateTime" class="control-label">Date/Time</label>
                        </div>
                        <div id="parkDateTimePicker" class="col-md-8 col-sm-9 input-group control-width-normal date datetimepicker">
                            <input type="text" name="transDateTime" value="" id="transDateTime" class="form-control" readonly >
                            <span class="input-group-addon">
                                <span class="glyphicon-calendar glyphicon"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4"> </div>
            </div>    
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn mod-action" id="saveParkCarbon">Save</button>        
        <button type="button" class="btn cancel" data-dismiss="modal">Cancel</button>
    </div>
</form> 
<script type="text/javascript">
    addDatePicker('parkDateTimePicker');
    addTypeahead('organization', 'organization', 0, 0);    
    addEvents();
    saveParkCarbon();    
</script>