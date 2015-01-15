var organizationList = new Object();
var programList = new Object();
var projectList = new Object();

$(document).ready(function () {

    $("a[data-target=#acsModal]").click(function (ev) {
        // ev.preventDefault();
        var target = $(this).attr("href");

        $("#acsModal .modal-content").load(target, function () {
            $("#acsModal").modal("show");
        });
    });

    $('#carbonTabs a').click(function (e) {
        e.preventDefault();

        var url = $(this).attr("data-url");
        var href = this.hash;
        var pane = $(this);

        $(href).load(url, function (result) {
            pane.tab('show');
        });
    });

    $('#brokered_carbon').load('/dashboard/brokered', function (result) {
        $('.active a').tab('show');
    });

    getAvailableCC();

});

(function ($) {
    $.fn.greenify = function () {
        this.css("color", "green");
        return this;
    };
}(jQuery));

var getAvailableCC = function () {
    url = '/dashboard/carbonCredit';
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        error: function () {
        },
        success: function (jsonData) {
            $('#availableCarbonCredit').html(jsonData.availableCC);
        }
    });
}

var loadPvDataGrid = function () {
    url = '/dashboard/pvDataGrid';
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'html',
        error: function () {
        },
        success: function (data) {
            $('#pvDataGrid').html(data);
        }
    });
}

var removeAcsModal = function () {
    $('#acsModal').modal('hide');
    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
    });
}

var addDatePicker = function (boxId) {

    $('#' + boxId).datetimepicker();
    $('#' + boxId).data("DateTimePicker").setDate(new Date($.now()));
}

var addEvents = function () {

    $('#acsModal').on('hidden.bs.modal', function () {
        removeAcsModal();
    });

    $("#organization").on('focusout', function () {
        var orgName = $.trim($(this).val());
        if (orgName != '') {
            makeProgram(orgName);
        }

        if (organizationList[orgName] && organizationList[orgName].type) {
            $('#organization_type').val(organizationList[orgName].type);
            $('#organization_type').attr("disabled", true);
        }
        else {
            $('#organization_type').val('company');
            $('#organization_type').attr("disabled", false);
        }

    });

    $("#programme").on('focusout', function () {
        var programName = $.trim($(this).val());
        if (programName != '') {
            makeProject(programName);
        }
    });

    $("#project").on('focusout', function () {
        var projectName = $.trim($(this).val());
        if (projectName != '') {
            if (projectList[projectName] && projectList[projectName].type) {
                $('#project_type').val(projectList[projectName].type);
                $('#project_type').attr("disabled", true);
            }
            else {
                $('#project_type').val('solar');
                $('#project_type').attr("disabled", false);
            }
        }
    });

    $(".cancel").on('click', function () {
        removeAcsModal();
    });


}

var resetProgram = function () {
    $('#programme').typeahead('destroy');
}

var resetProject = function () {
    $('#project').typeahead('destroy');
}

var makeProgram = function (orgName) {
    resetProgram();
    resetProject();
    var orgId = organizationList[orgName] != undefined ? organizationList[orgName].id : 0;
    if (orgId) {
        addTypeahead('programme', 'programme', orgId);
    }
}

var makeProject = function (programName) {
    resetProject();
    var programId = programList[programName] != undefined ? programList[programName].id : 0;
    if (programId) {
        addTypeahead('project', 'project', programId);
    }
}

var addTypeahead = function (boxId, url, id, makeDisable) {
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

                    if (makeDisable == 1) {
                        $("#organization").focus();
                        $('#organization_type').attr('disabled', 'disabled');
                    }
                }
                else if (boxId == 'programme') {
                    programList[item.name] = item;
                }
                else if (boxId == 'project') {
                    projectList[item.name] = item;
                }
            });
            /*
             var typeaheadEle = $('#' + boxId).data('typeahead');
             if (typeaheadEle) {
             typeaheadEle.source = [];
             }
             */
            $('#' + boxId).typeahead('destroy');

            $('#' + boxId).typeahead({
                source: acsItemNames
            });
        }
    });
}

var addCarbonTransaction = function (formId) {
    var form_data = $("#" + formId).serialize();
    $.ajax({
        url: '/dashboard/addTransactions',
        type: 'POST',
        dataType: 'html',
        data: form_data,
        error: function () {
        },
        success: function (data) {
            addTypeahead('organization', 'organization', 0);
            addEvents();
            removeAcsModal();
            getAvailableCC();
        }
    });
}

var validateBuyCarbon = function () {

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
            addCarbonTransaction('buyCarbonForm');
        }
    });

}

var saveBuyCarbon = function () {
    $('#saveBuyCarbon').click(function (e) {
        validateBuyCarbon();
    });
}


var validateSellCarbon = function () {

    $('#sellCarbonForm').validate({
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
            addCarbonTransaction('sellCarbonForm');
        }
    });

}

var saveSellCarbon = function () {
    $('#saveSellCarbon').click(function (e) {
        validateSellCarbon();
    });
}


var validateTransferCarbon = function () {
    //http://twitterbootstrap.org/live/bootstrap-form-validation/
    $('#transferCarbonForm').validate({
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
            addCarbonTransaction('transferCarbonForm');
        }
    });

}

var saveTransferCarbon = function () {
    $('#saveTransferCarbon').click(function (e) {
        validateTransferCarbon();
    });
}


var validateGrantCarbon = function () {
    $('#grantCarbonForm').validate({
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
            addCarbonTransaction('grantCarbonForm');
        }
    });

}

var saveGrantCarbon = function () {
    $('#saveGrantCarbon').click(function (e) {
        validateGrantCarbon();
    });
}

var validateParkCarbon = function () {
    $('#parkCarbonForm').validate({
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
            addCarbonTransaction('parkCarbonForm');
        }
    });

}

var saveParkCarbon = function () {
    $('#saveParkCarbon').click(function (e) {
        validateParkCarbon();
    });
}

var addPvData = function (formId) {
    var form_data = $("#" + formId).serialize();
    $.ajax({
        url: '/dashboard/addPvData',
        type: 'POST',
        dataType: 'html',
        data: form_data,
        error: function () {
        },
        success: function (data) {
            addTypeahead('organization', 'organization', 0);
            addEvents();
            removeAcsModal();
            loadPvDataGrid();
            getAvailableCC();
        }
    });
}

var validatePvData = function () {

    $('#addPvDataForm').validate({
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
            serialNumber: {
                required: true
            },
            kwReading: {
                required: true,
                number: true
            },
            carbon: {
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
            addPvData('addPvDataForm');
        }
    });

}

var savePvData = function () {
    $('#savePvData').click(function (e) {
        validatePvData();
    });
}

var loadOrgDataGrid = function () {
    url = '/dashboard/organizationDataGrid';
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'html',
        error: function () {
        },
        success: function (data) {
            $('#orgDataGrid').html(data);
        }
    });
}

var addOrgData = function (formId) {
    var form_data = $("#" + formId).serialize();
    $.ajax({
        url: '/dashboard/addOrganization',
        type: 'POST',
        dataType: 'html',
        data: form_data,
        error: function () {
        },
        success: function (data) {
            removeAcsModal();
            loadOrgDataGrid();
        }
    });
}

var validateOrgData = function () {

    $('#addOrgDataForm').validate({
        rules: {
            organization: {
                required: true
            }
        },
        highlight: function (element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        },
        success: function (element) {

        },
        submitHandler: function (form) {
            addOrgData('addOrgDataForm');
        }
    });

}

var saveOrgData = function () {
    $('#saveOrgData').click(function (e) {
        validateOrgData();
    });
}