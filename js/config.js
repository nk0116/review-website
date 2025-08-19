$(function () {
    $('#menubBtn').on('click', function () {
        let header = $('.headerSpwap').outerHeight();
        if($('.headerSpwap').offset().top===0){
            $('#gnavSp').css({'top':header,'position':'fixed'}); 
         }
        $('#gnavSp').slideToggle();
        if($(this).hasClass('off')) {
             $(this).removeClass('off').addClass('on');  
          } else {
             $(this).removeClass('on').addClass('off');  
          }
    });
});