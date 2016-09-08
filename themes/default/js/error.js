$(document).ready(function() {
    var error = $('#alertDivError').text();
    var success = $('#alertDivSuccess').text();
    if(error === '{ERRORMSG}') {
        $('#alertDivError').hide();
    }
    if(success === '{SUCCESSMSG}') {
        $('#alertDivSuccess').hide();
    }
});