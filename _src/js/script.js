$(document).ready(function(){
    DebugHandler();

    //SpeedUpHandler();
    DialogHandler();
    FormsHandler();
    //Timer();
    Hacks();
    CustomHandler();
    AutoGenerate();
    //GMapHandler();
    $('.search-submit').click(function(e){
      e.preventDefault();
      if ($('.search-input').val == '') {
        $(this).fadeIn();
      }
    });
});



var $modal = $('#modal-callback');
var $html = $('html');
var $body = $('body');

window.DEBUG_MODE = 0;

var DialogHandler = function() {
    function changeTextOrHide(selector, text) {
        if (text)
            $modal.find(selector).html( text).show();
        else
            $modal.find(selector).hide();
    }

    function changeValue(selector, val) {
        val = val ? val : '';
        $modal.find(selector).val( val );
    }

    $('.open-callback').click(function(e) {
        e.preventDefault();

        changeValue('#modal-additional', $(this).data('additional'));
        changeValue('#modal-goal', $(this).data('goal'));

        changeTextOrHide('#modal-title', $(this).data('title'));
        changeTextOrHide('#modal-btn', $(this).data('btn'));

        changeTextOrHide('#modal-subtitle', $(this).data('subtitle'));
        changeTextOrHide('#modal-subtext', $(this).data('subtext'));

        $modal.find('.order-form').data('result', $(this).data('result') ? $(this).data('result') : '');

        $modal.find('[id*=mode-]').hide()
            .find('input').attr('readonly','readonly');

        var fields = $(this).data('fields');
        fields = fields ? fields : 'name,phone';
        fields = fields.split(',');

        $.each(fields, function(idx, field){
            var $elem = $modal.find('#mode-' + field);
            $elem.find('input').removeAttr('readonly');
            $elem.show();
            if (field == 'time') {
                $modal.find('.order-form').data('result', $modal.find('.order-form').find('.btn-group-nav .active').data('result') );
            }
        });

        $modal.modal('show');
    });

    $modal.find("#mode-time .btn-group-nav a").click(function(e) {
        e.preventDefault();
        var $this = $(this);
        if ($this.hasClass('active'))
            return;

        $this.addClass("active");
        $this.siblings().removeClass("active");

        $this.parents('.order-form').data('result', $this.data('result'));
        $("input#i-100-whentime").slideToggle();
        $("input#i-100-whencall").val( $this.text() );
    }).eq(0).click();

    $('label[for]').on('click', function (e) {
        var target = window[this.htmlFor];
        target.checked = !target.checked;
        e.preventDefault();
    });
};

var afterSendExecuted;
var FormsHandler = function() {

    $('.btn-group input').bind('click keyup',function(){
        $(this).removeClass('error').parent().removeClass('error');
    });

    $('.order-form').ajaxForm({
        url:           '/template/order.php',
        beforeSubmit:  before_send,
        success:       after_send
    });

    $('input[type=text]').placeholder();
    $('input[name="phone"]').mask("+7 (999) 999-99-99");

    function before_send(formData, jqForm, options) {
        $('.btn-group .error').removeClass('error').parent().removeClass('error');

        var is_error = false;
        $.each(formData, function(idx, el){
            if (window.DEBUG_MODE & 4)
                return true;

            var $elem = jqForm.find( 'input[name=' + el.name + '], textarea[name=' + el.name + ']' );

            if ( $elem && $elem.length && el.type != 'hidden' && !el.value && !$elem.attr('readonly') && !$elem.hasClass('not-validate') ||
                (el.value && el.name=='email' && !$elem.attr('readonly') && !Util.validateEmail(el.value)) )
            {
                if ( $elem.hasClass('placeholder')) // ie
                {
                    $elem.addClass('error').parent().addClass('error');
                }
                else
                {
                    $elem.addClass('error').parent().addClass('error');
                    $elem.focus();
                }

                is_error = true;
                return false;
            }
        });

        if (is_error)
            return false;

        formData.push({name: 'version', value: window.VERSION ? window.VERSION : '' });

        try {
            formData.push({name: 'utm_type', value: sbjs.get.current.typ });

            formData.push({name: 'utm_source', value: sbjs.get.current.src });
            formData.push({name: 'utm_medium', value: sbjs.get.current.mdm });
            formData.push({name: 'utm_campaign', value: sbjs.get.current.cmp });

            formData.push({name: 'utm_term', value: sbjs.get.current.trm });
            formData.push({name: 'utm_content', value: sbjs.get.current.cnt });
        } catch (e) {}


        var result_text = jqForm.data('result');
        var default_result_text = 'В течение 5 минут с вами <br>свяжется наш менеджер';
        result_text = result_text ? result_text : default_result_text;
        $('#modal-result-text').html(result_text);

        if (window.DEBUG_MODE & 2) {
            var alert_result_text = "Result Text: " + result_text;
            var alert_text = "\n\nОсновная информация: \n";
            var alert_text_additional = "\nСлужебная информация: \n";
            var alert_text_utm = "\nUTM метки: \n";
            $.each(formData, function(idx, data){
                var text = data.name + ": " + data.value + "\n";

                var additional_fields = {
                    goal: 1, additional: 1,additional2: 1, version: 1
                };
                if (additional_fields[data.name]) {
                    alert_text_additional += text;
                } else if (data.name.substr(0,4) == 'utm_') {
                    alert_text_utm += text;
                } else {
                    alert_text += text;
                }
            });
            alert(alert_result_text + alert_text + alert_text_additional + alert_text_utm);
        }

        if (window.DEBUG_MODE & 1) {
            return false;
        }
        /*
            var goal = jqForm.find('[name=goal]').val();
            if (goal) {
                try {
                    yaCounter26980194.reachGoal( goal );
                    ga('send', 'event', 'lead', goal);
                }
                catch (e){ }
            }

            try {
                yaCounter26980194.reachGoal('send');
                ga('send', 'event', 'lead', 'all');
            }
            catch (e){ }
         */

        $('[type=submit]').attr('disabled','disabled');

        afterSendExecuted = false;
        setTimeout(function(){ after_send(null,null,null,jqForm); }, 700);

        return true;
    }

    function after_send(responseText, statusText, xhr, $form)  {
        if (afterSendExecuted)
            return;

        afterSendExecuted = true;
        $form.find('input[type=text]').val('');

        var $modal_result = $('#modal-result');
        if ($modal.is('.in'))
            $modal.modal('hide').one('hidden.bs.modal', function(){
                $modal_result.modal('show');
            });
        else
            $modal_result.modal('show');

        $modal.data('result','');
        $('input[type=submit], button[type=submit]').removeAttr('disabled');
    }
};

/*
var Timer = function() {
    function CountdownTimer(elm_id,tl,mes){
        this.initialize.apply(this,arguments);
    }
    function getRandomInt(min, max)
    {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }
    CountdownTimer.prototype={
        initialize:function(elm_id,tl,mes) {
            this.elem = document.getElementById(elm_id);
            this.elem_days = $('.js-timer-days');
            this.elem_hours = $('.js-timer-hours');
            this.elem_minutes = $('.js-timer-minutes');
            this.elem_seconds = $('.js-timer-seconds');

            this.elem_label_days = $('.js-label-days');
            this.elem_label_hours = $('.js-label-hours');
            this.elem_label_minutes = $('.js-label-minutes');
            this.elem_label_seconds = $('.js-label-seconds');

            this.tl = tl;
            this.mes = mes;

            this.countDown();
        },countDown:function(){
            var today=new Date();
            var day=Math.floor((this.tl-today)/(24*60*60*1000));
            var hour=Math.floor(((this.tl-today)%(24*60*60*1000))/(60*60*1000));
            var min=Math.floor(((this.tl-today)%(24*60*60*1000))/(60*1000))%60;
            var sec=Math.floor(((this.tl-today)%(24*60*60*1000))/1000)%60%60;
            var me=this;

            if( ( this.tl - today ) > 0 ){
                this.elem_days.text( this.addZero(day) );
                this.elem_hours.text( this.addZero(hour) );
                this.elem_minutes.text( this.addZero(min) );
                this.elem_seconds.text( this.addZero(sec) );

                this.elem_label_days.text( this.plural_str(day,'день','дня','дней') );
                this.elem_label_hours.text( this.plural_str(hour,'час','часа','часов') );
                this.elem_label_minutes.text( this.plural_str(min,'минута','минуты','минут') );
                this.elem_label_seconds.text( this.plural_str(sec,'секунда','секунды','секунд') );

                tid = setTimeout( function(){me.countDown();},500 );
            }
            else
            {
                return;
            }
        },addZero:function(num){ return ('0'+num).slice(-2); },
        plural:function (a){
            if ( a % 10 == 1 && a % 100 != 11 ) return 0
            else if ( a % 10 >= 2 && a % 10 <= 4 && ( a % 100 < 10 || a % 100 >= 20)) return 1
            else return 2;
        },
        plural_str:function (i, str1, str2, str3){
            switch (this.plural(i)) {
                case 0: return str1;
                case 1: return str2;
                default: return str3;
            }
        }
    };

    function CDT(){
        if (timer_type == 1) {
            var dateDown = $.cookie('cdt');
            var now = new Date();

            if (!dateDown || dateDown < now.getTime() && timer_days)
            {
                timer_days = parseInt(timer_days);
                dateDown = now.getTime() + timer_days*24*60*60*1000 + getRandomInt(1,4)*60*60*1000 - getRandomInt(1,4)*60*60*1000 - getRandomInt(1,26)*60*1000 + getRandomInt(1,26)*1000;
                $.cookie('cdt',dateDown, { expires: timer_days , path: '/' });
            }
            dateDown = new Date( parseInt(dateDown) );
        }
        else if (timer_type == 2) {
            dateDown = new Date( timer_date*1000  );
        }

        var tl = new Date(dateDown);
        var timer = new CountdownTimer('timer',tl,'');;
    }

    CDT();
};*/

window.isMobile = window.isMobile || false;
var Hacks = function() {
    if( isMobile.apple.device ) {
        $html.addClass( 'iOS' );

        var iOS_version = parseFloat(
                ('' + (/CPU.*OS ([0-9_]{1,5})|(CPU like).*AppleWebKit.*Mobile/i.exec(navigator.userAgent) || [0,''])[1])
                    .replace('undefined', '3_2').replace('_', '.').replace('_', '')
            ) || false;

        var int_iOS_version = parseInt(iOS_version);
        if (int_iOS_version)
            $html.addClass( 'iOS' + int_iOS_version );
    }
}

var CustomHandler = function() {
    if( !isMobile.any )
    {
        $('a[href*=tel]').removeAttr('href');
    }
    sbjs.init();
    $(".scrollTo").click(function(e) {
        e.preventDefault();
        $.scrollTo($(this).attr("href"), 1500, {
            interrupt: true
        });
    });
};





window.Gmap = null;
var GMapHandler = function() {
    var $map_wrapper = $('.wr17');                                      // map container
    var map_center_coords = "51.500390, 45.966099";      // center coordinates
    var map_marker_coords = "51.499929, 45.967740";     // marker coordinates
    var map_marker_icon = "img/marker.png";                  // icon marker url
    var map_zoom = 17;                                                       // map zoom

    if (!$map_wrapper.length)
    {
        console.log('[Gmap] Элемента не существует');
        return;
    }

    if (!window.map_coords)
    {
        console.log('[Gmap] Не заданы координаты в параметре map_coord. Используем стандартное значение');
        window.map_coords = "55.69777704873052,37.77824859751695;55.7535378290641,37.624929644118836;10";
    }
    var coords = window.map_coords.split(';');
    if (coords[0])
        map_center_coords = coords[0];
    if (coords[1])
        map_marker_coords = coords[1];
    if (coords[2])
        map_zoom = coords[2];

    map_center_coords = map_center_coords.split(",");
    map_marker_coords = map_marker_coords.split(",");
    map_zoom = parseInt(map_zoom);

    var window_height = $(window).height();
    var map_loaded = false;

    var map_offset_top = $map_wrapper.offset().top;

    setInterval(function(){
        if (!map_loaded)
            map_offset_top = $map_wrapper.offset().top;
    }, 2000);

    setInterval(function(){
        var scroll_top = $(document).scrollTop();

        if (!map_loaded && scroll_top > map_offset_top - window_height * 3) {
            $.getScript('http://maps.googleapis.com/maps/api/js?v=3.9&sensor=false&callback=gMapInitialize');
            map_loaded = true;
        }
    }, 20);

    window.gMapInitialize = function() {
        window.Gmap = new google.maps.Map(document.getElementById("gmap"), {
            zoom: map_zoom,
            center: new google.maps.LatLng(parseFloat(map_center_coords[0]), parseFloat(map_center_coords[1])),
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'tehgrayz']
            },
            scrollwheel: false
        });

        var mapType = new google.maps.StyledMapType([
            {
                featureType: "all",
                stylers: [
                    { hue: "#0000ff" },
                    { saturation: -95 }
                ]
            },
            {
                featureType: "poi",
                elementType: "label",
                stylers: [
                    { visibility: "off" }
                ]
            }
        ], { name:"Grayscale" });

        window.Gmap.mapTypes.set('tehgrayz', mapType);
        window.Gmap.setMapTypeId('tehgrayz');

        new google.maps.Marker({
            position: new google.maps.LatLng(parseFloat(map_marker_coords[0]), parseFloat(map_marker_coords[1])),
            map: window.Gmap,
            icon: {
                url: map_marker_icon,
                origin: new google.maps.Point(0, 0)
                //anchor: new google.maps.Point(40, 51),
                //scaledSize: new google.maps.Size(40, 51)
            }
        });

    }
};


var AutoGenerate = function() {
    //= ./_auto-generate/script.js
};

var DebugHandler = function() {
    try {
        if (window.location.search) {
            var params = {};
            $.each(window.location.search.substr(1).split('&'), function(idx, param){
                var param_arr = param.split('=');
                params[param_arr[0]] = parseInt(param_arr[1]);
            });
            if (params && params.debug) {
                var alert_text = "Включен DEBUG режим: \n";
                if (params.show_lines || params.show_block) {
                    $html.addClass('debug');
                    if (params.show_lines) {
                        $html.addClass('debug1');
                        alert_text += "[CSS] Отображается сетка \n";
                    }
                    if (params.show_block) {
                        $html.addClass('debug2');
                        alert_text += "[CSS] Отображается блок 980px \n";
                    }
                }
                if (params.disable_lazy) {
                    $('.lazy').removeClass('lazy');
                }
                if (params.disable_forms) {
                    window.DEBUG_MODE |= 1;
                    alert_text += "[JS] Отправка форм выключена \n";
                }
                if (params.alert_forms) {
                    window.DEBUG_MODE |= 2;
                    alert_text += "[JS] Вывод отправляемых полей \n";
                }
                if (params.disable_validation) {
                    window.DEBUG_MODE |= 4;
                    alert_text += "[JS] Выключена валидация полей \n";
                }

                alert_text += "Возможные опции: \n";
                alert_text += "show_lines \n";
                alert_text += "show_block \n";
                alert_text += "disable_lazy \n";
                alert_text += "disable_forms \n";
                alert_text += "alert_forms \n";
                alert_text += "disable_validation \n";
                alert_text += "disable_alert \n";

                if (params.disable_alert !== 1)
                    alert(alert_text);
            }
        }
    } catch(e){
        console.log(e);
    }
};


window.Util = {
    number_format : function(number, decimals, dec_point, thousands_sep) {
        number = (number + '')
            .replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + (Math.round(n * k) / k)
                        .toFixed(prec);
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
            .split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '')
                .length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1)
                .join('0');
        }
        return s.join(dec);
    },

    validateEmail : function(email) {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    },

    plural : function(n, forms) {
        return forms[n%10==1 && n%100!=11 ? 0 : n%10>=2 && n%10<=4 && (n%100<10 || n%100>=20) ? 1 : 2];
    }
};