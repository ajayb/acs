<form class="form-horizontal fv-form fv-form-bootstrap" method="post" name="buyCarbonForm" id="buyCarbonForm" >   
    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
    <input type="hidden" id="addType" name="addType" value="buy">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Buy Carbon</h4>
    </div>			
    <!-- /modal-header -->
    <div class="modal-body">

        <div class="form-group has-feedback">
            <label class="col-xs-3 control-label">Organization</label>
            <div class="col-xs-5">
                <input type="text" name="organization" id="organization" class="form-control" autocomplete="off">                               
            </div>
            <div class="col-xs-4">
                <select name="organization_type" id="organization_type" class="form-control">
                    <option value="company">Company</option>
                    <option value="university">University</option>
                    <option value="individual">Individual</option>
                </select>
            </div>
        </div>

        <div class="form-group has-feedback">
            <label class="col-xs-3 control-label">Programme</label>
            <div class="col-xs-5">
                <input type="text" name="programme" id="programme" class="form-control" autocomplete="off">                                
            </div>
        </div> 

        <div class="form-group has-feedback">
            <label class="col-xs-3 control-label">Project</label>
            <div class="col-xs-5">
                <input type="text" name="project" id="project" class="form-control" autocomplete="off">                               
            </div>
            <div class="col-xs-4">
                <select name="project_type" id="project_type" class="form-control">
                    <option value="solar">Solar</option>
                    <option value="wind">Wind</option>
                    <option value="water">Water</option>
                    <option value="geothermal">Geothermal</option>
                    <option value="biomass">Biomass</option>
                </select>
            </div>
        </div>

        <div class="form-group has-feedback">
            <label class="col-xs-3 control-label">Amount #</label>
            <div class="col-xs-5">
                <input type="text" name="amount" id="amount" class="form-control" autocomplete="off">                               
            </div>
        </div>

        <div class="form-group has-feedback">
            <label class="col-xs-3 control-label">Cost $</label>
            <div class="col-xs-5">
                <input type="text" name="cost" id="cost"  class="form-control" autocomplete="off">                                
            </div>
        </div>

        <div class="form-group has-feedback">
            <label class="col-xs-3 control-label">Date/Time</label>
            <div id="buyDateTimePicker" class="col-xs-5 input-group date datetimepicker">
                <input type="text" name="transDateTime" value="" id="transDateTime" class="form-control" readonly >
                <span class="input-group-addon">
                    <span class="glyphicon-calendar glyphicon"></span>
                </span>
            </div>
        </div>

    </div>			
    <!-- /modal-body -->
    <div class="modal-footer">
        <button type="button" class="btn btn-default closeModal" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="saveBuyCarbon">Save changes</button>
    </div>
</form> 
<script type="text/javascript">
    addDatePicker('buyDateTimePicker');
    addTypeahead('organization', 'organization', 0);    
    addEvents();
    saveBuyCarbon();
    
    $(".clsClear").on('click', function () {
        $('#buyCarbonForm')[0].reset();        
    });
</script>