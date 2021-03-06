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

    $(".sort_current span").click(function () {
        var id = $(this).attr('id');
        var name = $(".block_d-i").attr("id");
        $("#fon").css({'display':'block'});
        $("#load").fadeIn(1000,function () {
            $.ajax({
                url:'Engine/Handler.php',
                data:'sort_id='+id + '/' +name,
                type:'get',
                success:function (html) {
                    $(".items_middle").html(html).hide().fadeIn(2000);
                    $("#fon").css({'display':'none'});
                    $("#load").fadeOut(1000);
                }

            });
        });
    });


    /*ui-slider*/
    jQuery("#slider").slider({
        min: 0,
        max: 100000,
        values: [0,100000],
        range: true,
        stop: function(event, ui) {
            jQuery("input#minCost").val(jQuery("#slider").slider("values",0));
            jQuery("input#maxCost").val(jQuery("#slider").slider("values",1));

        },
        slide: function(event, ui){
            jQuery("input#minCost").val(jQuery("#slider").slider("values",0));
            jQuery("input#maxCost").val(jQuery("#slider").slider("values",1));
        }
    });


    jQuery("input#minCost").change(function(){

        var value1=jQuery("input#minCost").val();
        var value2=jQuery("input#maxCost").val();

        if(parseInt(value1) > parseInt(value2)){
            value1 = value2;
            jQuery("input#minCost").val(value1);
        }
        jQuery("#slider").slider("values",0,value1);
    });


    jQuery("input#maxCost").change(function(){

        var value1=jQuery("input#minCost").val();
        var value2=jQuery("input#maxCost").val();

        if (value2 > 100000) { value2 = 100000; jQuery("input#maxCost").val(100000)}

        if(parseInt(value1) > parseInt(value2)){
            value2 = value1;
            jQuery("input#maxCost").val(value2);
        }
        jQuery("#slider").slider("values",1,value2);
    });


    jQuery('input').keypress(function(event){
        var key, keyChar;
        if(!event) var event = window.event;

        if (event.keyCode) key = event.keyCode;
        else if(event.which) key = event.which;

        if(key==null || key==0 || key==8 || key==13 || key==9 || key==46 || key==37 || key==39 ) return true;
        keyChar=String.fromCharCode(key);

        if(!/\d/.test(keyChar))	return false;

    });

    /*************************/

});


def_min=0;
def_max=10000;
cur_min=0;
cur_max=8000;
