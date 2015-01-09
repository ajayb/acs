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
    $('#' + boxId).datetimepicker();

    $("#organization").on('focusout', function () {
        // console.log($('#organization').val());
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
                required: true
            },
            cost: {
                required: true
            }
        },
        highlight: function (element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        },
        success: function (element) {
            return true;
        }
    });

}

var addTypeahead = function (boxId, url) {
    url = '/dashboard/' + url;
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: {'_token': $("meta[name='csrf-token']").attr('content')},
        error: function () {
        },
        success: function (jsonData) {
            var acsItemNames = new Array();
            var acsItemIds = new Object();
            $.each(jsonData, function (index, item)
            {
                acsItemNames.push(item.name);
                acsItemIds[item.name] = item.id;
            });

            $('#' + boxId).typeahead({
                source: acsItemNames,
                highlighter: function (item) {
                    return item;
                },
                updater: function (item) {
                    //console.log("'" + item + "' selected.");
                    return item;
                }
            });
        }
    });
}

var saveBuyCarbon = function () {
    $('#saveBuyCarbon').click(function (e) {
        url = '/dashboard/addOrganization';
        if (validateBuyCarbon()) {
            var form_data = $("#buyCarbonForm").serialize();
            $.ajax({
                url: url,
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