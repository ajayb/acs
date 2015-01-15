<form class="form-horizontal fv-form fv-form-bootstrap" method="post" name="addOrgDataForm" id="addOrgDataForm" >   
    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">    
    <div class="modal-header">
        <button type="button" class="close cancel" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title" id="simpleModalLabel">Add Organization</h4>
    </div>
    <div class="modal-body">
        <form class="form-horizontal form-bordered form-banded" role="form">
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-md-4 col-sm-3">
                            <label for="organization" class="control-label">Name</label>
                        </div>
                        <div class="col-md-8 col-sm-9">                            
                            <input type="text" name="organization" id="organization" class="form-control" autocomplete="off"  autofocus placeholder="Organization Name">
                        </div>
                    </div>
                </div>                
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-md-4 col-sm-3">
                            <label for="email" class="control-label">Email</label>
                        </div>
                        <div class="col-md-8 col-sm-9">                            
                            <input type="text" name="email" id="email" class="form-control" autocomplete="off" placeholder="Email">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4"> </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-md-4 col-sm-3">
                            <label for="address" class="control-label">Address</label>
                        </div>
                        <div class="col-md-8 col-sm-9">                            
                            <input type="text" name="address" id="address" class="form-control" autocomplete="off" placeholder="Address"> 
                        </div>
                    </div>
                </div>               
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-md-4 col-sm-3">
                            <label for="city" class="control-label">City</label>
                        </div>
                        <div class="col-md-8 col-sm-9">                            
                            <input type="text" name="city" id="city" class="form-control" autocomplete="off" placeholder="City"> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-4"> </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-md-4 col-sm-3">
                            <label for="state" class="control-label">State</label>
                        </div>
                        <div class="col-md-8 col-sm-9">                            
                            <input type="text" name="state" id="state" class="form-control" autocomplete="off" placeholder="State"> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-4"> </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-md-4 col-sm-3">
                            <label for="country" class="control-label">Country</label>
                        </div>
                        <div class="col-md-8 col-sm-9">                            
                            <input type="text" name="country" id="country" class="form-control" autocomplete="off" placeholder="Country"> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-4"> </div>
            </div>                        
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-md-4 col-sm-3">
                            <label for="zip_code" class="control-label">Zip Code</label>
                        </div>
                        <div class="col-md-8 col-sm-9">                            
                            <input type="text" name="zip_code" id="zip_code" class="form-control" autocomplete="off" placeholder="Zip Code">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4"> </div>
            </div>                
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn mod-action" id="saveOrgData">Save</button>        
        <button type="button" class="btn cancel" data-dismiss="modal">Cancel</button>
    </div>
</form>
<script type="text/javascript">    
    saveOrgData();
</script>