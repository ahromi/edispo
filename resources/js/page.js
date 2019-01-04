$('ul#widget-menu li a.w-link').click(function(){
    var widget = $(this).next();
    if ($(this).hasClass('active') == true) {
        widget.hide();
        $(this).removeClass('active');
        if (!jQuery.browser.msie || (jQuery.browser.msie && jQuery.browser.version == 9.0)) 
            $('#panel-outer').fadeTo('50', 1)
    }
    else {
        $('ul#widget-menu li a.w-link').removeClass('active');
        $(this).addClass('active');
        $('.widget').hide();
        setTimeout(function(){
            widget.fadeIn(50)
        }, 50);
        if (!jQuery.browser.msie || (jQuery.browser.msie && jQuery.browser.version == 9.0)) 
            $('#panel-outer').fadeTo('50', 0.5)
    }
    return false
});
function close_widgets(){
    $('ul#widget-menu li a.w-link').removeClass('active');
    $('.widget').hide();
    if (!jQuery.browser.msie || (jQuery.browser.msie && jQuery.browser.version == 9.0)) 
        $('#panel-outer').fadeTo('50', 1);
    return false
}

$(document).click(function(e){
    close_widgets()
});
$('#widgets').click(function(e){
    e.stopPropagation()
});
$('.widget').click(function(e){
    e.stopPropagation()
});
function layout_handler(obj, toclass){
    $('#sub-menu li a').removeClass('active');
    $(obj).addClass('active');
    if (toclass == 'clear') 
        $('body').removeClass();
    else 
        $('body').removeClass().addClass(toclass)
}