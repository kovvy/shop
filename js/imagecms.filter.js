$(document).ready(function(){
    apply_value = 0;
    /*    Filter Init    */
    //jQuery('.check_form input, .formCost input').on('change', ajaxRecount);
    /*
    $('.formCost input').on("change",function(){
        alert('q');
    });
    */
    slider_el = $("#slider");
    if ($.exists_nabir(slider_el)){
        slider_el.slider({
            min: def_min,
            max: def_max,
            values: [cur_min,cur_max],
            range: true,
            slide: function(event, ui){
                $("input#minCost").val(ui.values[0]);
                $("input#maxCost").val(ui.values[1]);
            },
            stop: function(){
                $('.sliderCont').mouseup();
            },
            start: function(){
                $('.sliderCont').find('.apply').hide();
            }
        });
        $("input#minCost").change(function(){
            var value1=$("input#minCost").val();
            var value2=$("input#maxCost").val();
            if(parseInt(value1) > parseInt(value2)){
                value1 = value2;
                $("input#minCost").val(value1);
            }
            slider_el.slider("values",0,value1);
        }); 
        $("input#maxCost").change(function(){
            var value1=$("input#minCost").val();
            var value2=$("input#maxCost").val();

            if (value2 > def_max) {
                value2 = def_max;
                $("input#maxCost").val(def_max)
            }

            if(parseInt(value1) > parseInt(value2)){
                value2 = value1;
                $("input#maxCost").val(value2);
            }
            slider_el.slider("values",1,value2);
        });
    }
    $('#catalogue_form').on('keypress', function(event){
        if (event.keyCode == 13)
        {
            $(this).find('button:first').click(function(){
                return false;
            });
            $("input#minCost").change();
            $("input#maxCost").change();
            $('.sliderCont').mouseup();
        }
    });
    $('.sliderCont').on('mouseup', ajaxRecount);
    $('.check_frame input, .formCost input').on('change', ajaxRecount);
    jQuery.exists_nabir = function(nabir){
        return (nabir.length > 0);
    }
    jQuery.exists = function(selector) {
        return ($(selector).length > 0);
    }
    jQuery('.apply').live('click', function(){
        $(this).parents('form').submit();
        return false;
    });
    
    function ajaxRecount() {
        
        var $this = $(this);
        var filterResponse = new String;
        $this.closest('form').ajaxSubmit({
            success: function(responseText, statusText, xhr, $form){
                filterResponse = $.parseJSON(responseText);
                apply_value = filterResponse.totalCount;
                //alert(filterResponse.totalCount);
            
                for (x in filterResponse.brands) {
                    var brand = filterResponse.brands[x];
                    var selector = $('#brand_' + brand.id);
                    //selector.parent().children().eq(2).text('(' + brand.count + ')');
                    if (brand.disabled == 'false') {
                        selector.removeClass('disabled');
                        selector.find('input').attr('disabled',false)
                    } else if (brand.disabled == 'true'){
                        selector.addClass('disabled');
                        selector.find('input').attr('disabled',true)
                    }
                }
                
                for (x in filterResponse.properties) {
                    var property = filterResponse.properties[x];
                    var selector = $('#prop_' + property.id);
                    //alert('#prop_' + property.id);
                    //selector.parent().children().eq(2).text('(' + property.count + ')');
                    if (property.disabled == 'false') {
                        selector.removeClass('disabled');
                        selector.find('input').attr('disabled',false)
                    } else if (property.disabled == 'true'){
                        selector.addClass('disabled');
                        selector.find('input').attr('disabled',true)
                    }
                }
                //apply_value = filterResponse.totalCount;
                
                var value1=jQuery(".price_block input#minCost").val();
                var value2=jQuery(".price_block input#maxCost").val();
                if(parseInt(value1) > parseInt(value2)){
                    value1 = value2;
                    jQuery(".price_block input#minCost").val(value1);
                }
                jQuery(".price_block #slider").slider("values",0,value1);
                $this.parent().parent().parent().children('.check_form').find('div').hide();

                left=$this.parent().width();

                if ($this.is('input') && $this.attr('id') != 'minCost' && $this.attr('id') != 'maxCost') {
                    var input = $this;
                    if($.exists(input.parent().parent().parent(':not(.disabled)'))){
                        input.parents('form').find('.filter_ajax_checks').find('.frame_label.active').not(input.parent().parent().parent()).toggleClass('active').find('.apply').stop().hide(200);
                        input.parent().parent().parent().addClass('active');
                        left = input.parent().parent().outerWidth(true)-3;
                        if(!$.exists_nabir(input.parent().parent().parent().find('.apply'))){
                            win=input.parent().parent().parent().append("<span class='apply'><span><a href='#'>Показать</a>"+'Найдено <span class="count_find">'+filterResponse.totalCount+'</span> товаров'+"</span></span>");
                        }
                        else
                        {
                            win.find('.count_find').html(filterResponse.totalCount);
                        }
                        input.parent().parent().parent().find('.apply').stop().show(200);
                        win.find('.apply').css('left',left);
                    }
                /*
                    if($.exists_nabir($this.parent(':not(.disabled)'))){
                        $this.parent().parents('form').find('.check_form').find('label.active').not($this.parent()).toggleClass('active').find('.apply').stop().hide(200);
                        $this.parent().addClass('active');
                        left=$this.parent().width();
                        if(!$.exists_nabir($this.parent().find('.apply'))){
                            win=$this.parent().append("<span class='apply'><span><span>"+'Найдено <span>'+filterResponse.totalCount+'</span> товаров'+"</span><a href='#'>Показать</a></span></span>");
                            $this.parent().find('.apply').stop().show(200);
                        }
                        else{
                            $this.parent().find('.apply').stop().show(200);
                        }
                        win.find('.apply').css('left',left+7);
                    }
                    */
                }else {
                    slider_el = $("#slider");
                    left_s = slider_el.outerWidth(true)+8;
                    if(!$.exists_nabir($('.sliderCont').find('.apply'))){
                        win_s=$('.sliderCont').append("<span class='apply'><span><a href='#'>Показать</a>"+'Найдено <span class="count_find">'+filterResponse.totalCount+'</span> товаров'+"</span></span>");
                    }
                    else{
                        win_s.find('.count_find').html(filterResponse.totalCount);
                    } 
                    $('.sliderCont').find('.apply').stop().show(200);
                    win_s.find('.apply').css('left',left_s);
                }
                
            }
        });
    }
});