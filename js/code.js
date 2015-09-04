$.exists = function(selector) {
    return ($(selector).length > 0);
}
$.exists_nabir = function(nabir){
    return (nabir.length > 0);
}
var	ie = $.browser.msie,
ieV = $.browser.version,
ltie7 = ie&&(ieV <= 7),
ltie8 = ie&&(ieV <= 8);

$(document).ready(function(){
    if ($.exists('.niceCheck')) {
        $(".niceCheck").each(function() {
            changeCheckStart($(this));
        });
    }
    $(".frame_label > *").click(function() {
        changeCheck($(this).find('> span:eq(0)'));
        $(this).parents('.frame_label').find('input').change();
        return false;
    });
    function changeCheck(el)
    {
        var el = el,
        input = el.find("input");
        if (input.is("[type='checkbox']")){
            active_b_p = '-207px -21px';
            n_active_b_p = '-196px -21px';
        }
        else if (input.is("[type='radio']")){
            active_b_p = '-268px 0';
            n_active_b_p = '-255px 0';
        }
        if(!input.attr("checked")) {
            el.css("background-position", active_b_p);
            el.parent().parent().addClass('active');
            input.attr("checked", true);
        }
        else if(input.is("[type='checkbox']:checked")){
            el.css("background-position", n_active_b_p);
            input.attr("checked", false);
        }
        if(input.is("[type='radio']")) {
            no_check_radio = $("[name="+input.attr('name')+"]").not(':checked').parent();
            no_check_radio.css("background-position", n_active_b_p);
            no_check_radio.parent().parent().removeClass('active');
            no_check_radio.find('input').attr("checked", false);
        }
    }
    function changeCheckStart(el)
    {
        var el = el,
        input = el.find("input");
        if (input.is("[type='checkbox']")){
            active_b_p = '-207px -21px';
            n_active_b_p = '-196px -21px';
        }
        else if (input.is("[type='radio']")){
            active_b_p = '-268px 0';
            n_active_b_p = '-255px 0';
        }
        if(input.attr("checked")){
            el.css("background-position", active_b_p);
            el.parent().parent().addClass('active');
            input.attr("checked", true);
        }
        else {
            el.css("background-position", n_active_b_p);
            el.parent().parent().removeClass('active');
            input.attr("checked", false);
        }
        el.removeClass('b_n');
    }



    $('.all_show').click(function(){
        $(this).prev().slideToggle();
        $(this).toggleClass('up');
        return false;
    });
    $('.leave_coment .pointer, .dol .pointer, .sort .pointer').live("click", function(){
        $(this).next().toggle('300').toggleClass('active_drop').end().find('.icon').toggleClass('up').end().parent().toggleClass('active_parent');
    });
    $('.leave_coment > span').live("click", function(){
        $(this).toggleClass('active_b_com');
    });

    time_dur_m = 300;
    $('#nav > li').hover(
        function(){
            $this = $(this).children('div');
            hover_t_o = setTimeout(function(){
                $this.show();
            }, time_dur_m);
        },function(){
            $this = $(this).children('div');
            clearTimeout(hover_t_o);
            $this.hide();
        });

        $('#nav > li:first-child').hover(function(){
            art_h = $('article').outerHeight();
            if (art_h < 20604 ){
                $('article').css('height','700')
            }},
        function(){
            art_h = $('article').outerHeight();
            if (art_h < 20704 ){
                $('article').css('height','auto');
            }
        });


    $('#nav').hover(function(){
        time_dur_m = 0;
    }, function(){
        time_dur_m = 300;
    });

    if ($.exists('#nav')) {
        $('.not-js').removeClass();
    }
    bef = $('.bef');
    bef.each(function(){
        $(this).css('height',$(this).parents('.drop_menu').height());
    })

    function tabs(elem){
        tab_li_a = $(elem);
        tab_li_d_t = tab_li_a.data('tab');
        $('div[data-tab]').hide();
        $('div[data-tab="'+tab_li_d_t+'"]').show();
        tab_li_a.addClass('active');
    }
    tabs( $('.inside .tabs li:eq(0)') );
    $('.inside .tabs li').click(function(){
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
        tabs($(this));
    });


    if (ltie7){
        $("form").on("keypress", "input,select", function(e){
            if (e.keyCode == 13)
                $("button:first:not(disabled)", this.form).trigger('click');
        });
        $("button:not(disabled)").click(function(){
            $(this).parents('form').submit();
        });
        l_d_w = 0;
        $('.comparison_slider_right').each(function(){
            $(this).find('.list_desire').each(function(){
                l_d_w+= $(this).outerWidth(true)
            });
            $(this).css('width',l_d_w);
            l_d_w = 0;
        })
    }

});


def_min=0;
def_max=10000;
cur_min=0;
cur_max=8000;
