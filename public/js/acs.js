var organizationList = new Object();
var programList = new Object();
var projectList = new Object();

$(document).ready(function () {

    $('#carbonTabs a').click(function (e) {
        e.preventDefault();

        var url = $(this).attr("data-url");
        var href = this.hash;
        var pane = $(this);

        $(href).load(url, function (result) {
            pane.tab('show');
        });
    });

// load first tab content
    $('#brokered_carbon').load($('.active a').attr("data-url"), function (result) {
        $('.active a').tab('show');
    });
});

(function ($) {
    $.fn.greenify = function () {
        this.css("color", "green");
        return this;
    };
}(jQuery));


var addDatePicker = function (boxId) {
    //http://eonasdan.github.io/bootstrap-datetimepicker/
    $('#' + boxId).datetimepicker();
    $('#' + boxId).data("DateTimePicker").setDate(new Date($.now()));
}

var addEvents = function () {
    $("#organization").on('focusout', function () {
        var orgName = $.trim($(this).val());
        if (orgName != '') {
            //makeOrganization(orgName);
            makeProgram(orgName);
        }
    });

    $("#programme").on('focusout', function () {
        var programName = $.trim($(this).val());
        if (programName != '') {
            //makeProgram(programName);
            makeProject(programName);
        }
    });

    $("#project").on('focusout', function () {
        var projectName = $.trim($(this).val());
        if (projectName != '') {
            //makeProject(projectName);
        }
    });
}

var makeOrganization = function (orgName) {
    //var orgId = organizationList[orgName] != undefined ? organizationList[orgName].id : 0;    
    // addTypeahead('organization', 'organization', 0);
}

var makeProgram = function (orgName) {
    console.log(orgName);
    var orgId = organizationList[orgName] != undefined ? organizationList[orgName].id : 0;
    addTypeahead('programme', 'programme', orgId);
}

var makeProject = function (programName) {
    console.log(programName);
    var programId = programList[programName] != undefined ? programList[programName].id : 0;
    addTypeahead('project', 'project', programId);
}

var addTypeahead = function (boxId, url, id) {
    url = '/dashboard/' + url;
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: {'_token': $("meta[name='csrf-token']").attr('content'), 'id': id},
        error: function () {
        },
        success: function (jsonData) {
            var acsItemNames = new Array();

            $.each(jsonData, function (index, item)
            {
                acsItemNames.push(item.name);
                if (boxId == 'organization') {
                    organizationList[item.name] = item;
                }
                else if (boxId == 'programme') {
                    programList[item.name] = item;
                }
                else if (boxId == 'project') {
                    projectList[item.name] = item;
                }
            });

            var typeaheadEle = $('#' + boxId).data('typeahead');
            if (typeaheadEle) {
                typeaheadEle.source = [];
            }

 
            $('#' + boxId).typeahead('destroy');
            $('#' + boxId).typeahead({
                source: acsItemNames,
                highlighter: function (item) {
                    return item;
                },
                updater: function (item) {
                    console.log(boxId + "'" + item + "' selected.");

                    if (boxId == 'organization') {
                        // makeOrganization(item);
                        makeProgram(item);
                    }
                    else if (boxId == 'programme') {
                        //makeProgram(item);
                        makeProject(item);
                    }
                    else if (boxId == 'project') {
                        // makeProject(item);
                    }

                    return item;
                }                
            });
        }
    });
}

var validateBuyCarbon = function () {
    //http://twitterbootstrap.org/live/bootstrap-form-validation/
    $('#buyCarbonForm').validate({
        rules: {
            organization: {
                required: true
            },
            programme: {
                required: true
            },
            project: {
                required: true
            },
            amount: {
                required: true,
                number: true
            },
            cost: {
                required: true,
                number: true
            }
        },
        highlight: function (element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        },
        success: function (element) {

        },
        submitHandler: function (form) {
            var form_data = $("#buyCarbonForm").serialize();
            $.ajax({
                url: '/dashboard/addTransactions',
                type: 'POST',
                dataType: 'html',
                data: form_data,
                error: function () {
                },
                success: function (data) {

                }
            });
        }
    });

}

var saveBuyCarbon = function () {
    $('#saveBuyCarbon').click(function (e) {
        validateBuyCarbon();
    });
}