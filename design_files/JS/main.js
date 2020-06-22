
$(document).ready(function(){
    $('.numberCounter').counterUp({
        delay: 20,
        time: 1500
    });

    $(window).scroll(function(){
        if($(this).scrollTop()>320){
            $('.go_up').fadeIn();
        }
        else{
            $('.go_up').fadeOut();
        }
    });

    $("#stat-tab").click(function(){
        $('html, body').animate({
            scrollTop: $(".stat-section").offset().top-100
        }, 1500);
    });

    $('.go_up').click(function(){
        $('html, body').animate({ 
            scrollTop: 0 
        }, 1500);
    });


    $('.filterAsideHandler').click(function(){
        $('.sidebarBackground').fadeIn();
        $('.filterPanel').show();
        $('body').addClass('position-fixed');
        setTimeout(function(){
            $('.filterPanel').css("margin-left","0px");
        }, 80);
    });

    $('.filterAsideCloseBtn').click(function(){
        $('.filterPanel').css("margin-left","-322px");
        $('body').removeClass('position-fixed');
        setTimeout(function(){
            $('.filterPanel').css("display","none");
            $('.sidebarBackground').fadeOut();
        }, 202);
    });
});
