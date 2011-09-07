$(document).ready(function(){
    $("#password").bind({
        "blur": function (e) {
            text_validation($(this));
        },
        "focus": function (e) {
            $(this).parent().parent().removeClass('error') ;
            $(this).parent().find(".help-inline").remove() ;
        }
    });
    
    $("#new_password").bind({
        "blur": function (e) {
            text_validation($(this));
        },
        "focus": function (e) {
            $(this).parent().parent().removeClass('error') ;
            $(this).parent().find(".help-inline").remove() ;
        }
    });
    
    $("#new_password2").bind({
        "blur": function (e) {
            text_validation($(this));
        },
        "focus": function (e) {
            $(this).parent().parent().removeClass('error') ;
            $(this).parent().find(".help-inline").remove() ;
        }
    });
});

function text_validation (element) {
    if( $(element).val().length == 0 ) {
        if ( $(element).parent().parent().hasClass('error') == false ) {
            $(element).parent().parent().addClass('error') ;
            var span = $("<span>").attr('class', 'help-inline').html(text_error_required);
            $(element).parent().append(span) ;
        }
        return false;
    }
    return true;
}

function doSubmit() {
    var error = false;
    if ( !text_validation($("#password")) ) {
        error =  true;
    }
    
    if ( !text_validation($("#new_password")) ) {
        error =  true;
    }
    
    if ( !text_validation($("#new_password2")) ) {
        error =  true;
    }
    
    return !error;
}