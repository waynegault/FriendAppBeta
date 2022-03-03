// https://stackoverflow.com/questions/377644/jquery-ajax-error-handling-show-custom-exception-messages
$("div#errorcontainer")
    .ajaxError(
        function(e, x, settings, exception) {
            var message;
            var statusErrorMap = {
                '400' : "Server understood the request, but request content was invalid.",
                '401' : "Unauthorized access.",
                '403' : "Forbidden resource can't be accessed.",
                '500' : "Internal server error.",
                '503' : "Service unavailable."
            };
            if (x.status) {
                message =statusErrorMap[x.status];
                if(!message){
                    message="Unknown Error \n.";
                }
            }else if(exception=='parsererror'){
                message="Error.\nParsing JSON Request failed.";
            }else if(exception=='timeout'){
                message="Request Time out.";
            }else if(exception=='abort'){
                message="Request was aborted by the server";
            }else {
                message="Unknown Error \n.";
            }
            $(this).css("display","inline");
            $(this).html(message);
        });
