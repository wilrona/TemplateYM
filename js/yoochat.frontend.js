(function($) {
    $(document).ready(function() {

        // traitement de la session de l'utilisateur

        var IP;
        var country;

        var config = {
            apiKey: data.firebase.apiKey,
            authDomain: data.firebase.authDomain,
            databaseURL: data.firebase.databaseURL,
            projectId: data.firebase.projectId,
            storageBucket: data.firebase.storageBucket,
            messagingSenderId: data.firebase.messagingSenderId
        };

        firebase.initializeApp(config);

        firebase.auth().signInAnonymously().catch(function(error) {
            // Handle Errors here.
            var errorCode = error.code;
            var errorMessage = error.message;
            // ...
        });

        var database = firebase.database();

        var session = database.ref('SESSION');
        var track = database.ref('MESSAGE');
        var user_admin = database.ref('ADMIN');

        // current date




        if( ifvisible.now() ){



            // Annulation des session d'utilisateur qui ont déja fait plus d'inactivité
            // session.on('value', function(snapshot) {
            //     snapshot.forEach(function(childSnapshot) {
            //         var childKey = childSnapshot.key;
            //         var childData = childSnapshot.val();
            //
            //         var hour = currentDate.getHours();
            //         var previousDate = currentDate.setHours(hour - 12);
            //         if(childData.status === 1 && childData.dateUpdate <= previousDate){
            //             database.ref('SESSION/'+childKey).child('status').set(0);
            //         }
            //     });
            // });

            // Suppression des administrateurs qui ont déja fait plus d'1 heure sans activité
            // Signaler si il y'a un admin ou pas
            user_admin.on('value', function(snapshot) {
                var count_admin = 0;
                var currentDate = new Date();

                snapshot.forEach(function(childSnapshot) {
                    var childKey = childSnapshot.key;
                    var childData = childSnapshot.val();

                    // var hour = currentDate.getHours();
                    // var previousDate = currentDate.setHours(hour - 1);
                    // if(childData.dateUpdate <= previousDate){
                    //     database.ref('ADMIN/'+childKey).update({
                    //         connect: 0
                    //     });
                    // }

                    if(childData.connect === 1){
                        count_admin++;
                    }
                });

                if(count_admin > 0){
                    jQuery('#wp-live-chat-text').show();
                }else{
                    jQuery('#wp-live-chat-text').hide();
                }
            });

            var browser = '';

            // $.get("http://ipinfo.io/?token=b197ac2ed54478", function(response) {

                var date = new Date().getTime();

                if ($.browser.mozilla && $.browser.version >= "2.0" ){ browser = 'Mozilla'; }

                if( $.browser.safari ){ browser = 'Safari' }

                if( $.browser.opera){   browser = 'Opéra'  }

                if ($.browser.msie && $.browser.version <= 6 ){ browser = 'IE 6 or below version'; }

                if ($.browser.msie && $.browser.version > 6){  browser = 'IE above 6'; }

                if(!!window.chrome && !!window.chrome.webstore){  browser = 'Chrome' }

                var previous_page = Cookies.get('previous_page');

                if(!Cookies.get('session')){

                    // IP = response.ip;
                    // country = response.country;

                    var save = session.push({
                        page : window.location.href,
                        // IP: IP,
                        // country: country,
                        date : date,
                        dateUpdate:date,
                        navigateur: browser,
                        status : 1,
                        closed: 0,
                        news: 1
                    });

                    Cookies.set('session', save.key, { expires: 0.5 });
                    Cookies.set('previous_page', window.location.href);

                    track.push({
                        session : save.key,
                        timestamp : date,
                        texte : window.location.href,
                        type : 'track',
                        model:'track'
                    });

                }else{

                    var news = false;

                    var starCountRef = database.ref('SESSION/'+Cookies.get('session'));
                    starCountRef.once('value').then(function (snapshot) {
                        if(snapshot.val()){
                            if (snapshot.val().status === 0){
                                if(snapshot.val().closed === 0){
                                    dataUpdate = {
                                        page : window.location.href,
                                        // IP: IP,
                                        // country: country,
                                        date : date,
                                        dateUpdate:date,
                                        navigateur: browser,
                                        status : 1,
                                        closed: 0,
                                        news: 0
                                    }
                                    database.ref('SESSION/'+snapshot.key).update(dataUpdate);
                                    Cookies.set('session', snapshot.key, { expires: 0.5 });
                                    // database.ref('SESSION/'+snapshot.key).child('dateUpdate').set(date);
                                }else{
                                    // IP = response.ip;
                                    // country = response.country;

                                    var save = session.push({
                                        page : window.location.href,
                                        // IP: IP,
                                        // country: country,
                                        date : date,
                                        dateUpdate:date,
                                        navigateur: browser,
                                        status : 1,
                                        closed: 0,
                                        news: 1
                                    });

                                    Cookies.set('session', save.key, { expires: 0.5 });
                                    Cookies.set('previous_page', window.location.href);

                                    track.push({
                                        session : save.key,
                                        timestamp : date,
                                        texte : window.location.href,
                                        type : 'track',
                                        model:'track'
                                    });

                                    news = true;
                                }

                            }
                        }else{
                            // IP = response.ip;
                            // country = response.country;

                            var save = session.push({
                                page : window.location.href,
                                // IP: IP,
                                // country: country,
                                date : date,
                                dateUpdate: date,
                                navigateur: browser,
                                status : 1,
                                closed: 0,
                                news: 1
                            });

                            Cookies.set('session', save.key, { expires: 0.5 });
                            Cookies.set('previous_page', window.location.href);

                            track.push({
                                session : save.key,
                                timestamp : date,
                                texte : window.location.href,
                                type : 'track',
                                model:'track'
                            });

                            news = true;
                        }
                    });

                    if(news === false){

                        if(previous_page !== window.location.href){

                            track.push({
                                session : Cookies.get('session'),
                                timestamp : date,
                                texte : window.location.href,
                                type : 'track',
                                model:'track'
                            });

                        }

                        Cookies.set('previous_page', window.location.href);

                    }


                }

            // }, "jsonp");

        }



        var isClose = false;

        document.onkeydown = checkKeycode;

        function checkKeycode(e) {
            var keycode;
            if (window.event)
                keycode = window.event.keyCode;
            else if (e)
                keycode = e.which;
            if(keycode == 116)
            {
                isClose = true;
            }

        }

        $( "body" ).mousedown(function() {
            isClose = true;
        });

        window.onbeforeunload = function () {

            var date = new Date().getTime();

            if(!isClose){

                dataUpdate = {
                    page : window.location.href,
                    // IP: IP,
                    // country: country,
                    date : date,
                    dateUpdate: date,
                    navigateur: browser,
                    status : 0,
                    closed: 0,
                    news: 0
                };
                database.ref('SESSION/'+Cookies.get('session')).update(dataUpdate);

            }else{
                dataUpdate = {
                    page : window.location.href,
                    // IP: IP,
                    // country: country,
                    date : date,
                    dateUpdate: date,
                    navigateur: browser,
                    status : 1,
                    closed: 0
                };
                database.ref('SESSION/'+Cookies.get('session')).update(dataUpdate);
            }
        };

        // Traitement de la conversation

        $body = $('body');

        $body.append('<div id="yoochat"></div>');

        var ajaxurl = data.url_admin;

        var datas = {
            'action': 'load_yoochat_frontend',
            'security': data.secur
        };

        $.post(ajaxurl, datas, function(response) {
            $('body #yoochat').append(response);
        });

        track.on('value', function (snapshot) {
            var count_message = 0;

            var offline = false;

            jQuery('body #yoochat .chatbox__body').html('');

            snapshot.forEach(function(childSnapshot) {
                var childKey = childSnapshot.key;
                var childData = childSnapshot.val();

                var dateChild = childData.timestamp;
                var DateConvert = new Date(dateChild);

                var $message = '';

                if (childData.session === Cookies.get('session')) {


                    if(childData.type === 'msg' && !childData.user_id){
                        if(childData.model === 'auto'){
                            $message = jQuery('<div>').addClass('chatbox__body__message chatbox__body__message--right').html('<div class="img uk-text-uppercase">Y</div><p>'+childData.texte+'</p><span class="time">'+DateConvert.getHours()+':'+DateConvert.getMinutes()+'</span>')
                            jQuery('body #yoochat .chatbox__body').append($message);
                        }else{

                            $message = jQuery('<div>').addClass('chatbox__body__message chatbox__body__message--left').html('<div class="img uk-text-uppercase">'+childData.name.charAt(0)+'</div><p>'+childData.texte+'</p><span class="time">'+DateConvert.getHours()+':'+DateConvert.getMinutes()+'</span>')
                            jQuery('body #yoochat .chatbox__body').append($message);
                            // $message.insertAfter(jQuery('.chatbox__body__message:last-child'));
                        }


                    }

                    if(childData.type === 'msg' && childData.user_id){
                        $message = jQuery('<div>').addClass('chatbox__body__message chatbox__body__message--right').html('<div class="img uk-text-uppercase">Y</div><p>'+childData.texte+'</p><span class="time">'+DateConvert.getHours()+':'+DateConvert.getMinutes()+'</span>')
                        jQuery('body #yoochat .chatbox__body').append($message);
                        // $message.insertAfter(jQuery('.chatbox__body__message:last-child'));


                    }


                    if(childData.name && childData.model === 'msg'){
                        offline = true;
                    }


                    if ($message) {
                        count_message++;
                    }

                    database.ref('SESSION/'+childData.session).update({news: 0})


                }



            });
            if(count_message > 0){
                if(offline === true){
                    jQuery('body #yoochat .chatbox').removeClass('chatbox--empty');
                    console.log('eco');
                }
                jQuery('body #yoochat .chatbox__body').show();

                if(jQuery('#yoochat .chatbox').hasClass('chatbox--closed')){
                    jQuery('#yoochat .chatbox').removeClass('chatbox--closed');
                    jQuery('#wp-live-chat-header').addClass('active');
                }
                // jQuery('body #yoochat #wp-live-chat-header').trigger('click');
            }

            jQuery("body #yoochat .chatbox__body").stop().animate({ scrollTop: jQuery("body #yoochat .chatbox__body")[0].scrollHeight}, 1);

        });

        /// Envoie de message à l'operateur en ligne
        jQuery("body").on("keydown", ".chatbox__message", function (e) {
            var date = new Date().getTime();
            var inputValue = jQuery(this).val();
            if(e.keyCode === 13) {

                var starCountRef = database.ref('SESSION/'+Cookies.get('session'));
                starCountRef.once('value').then(function (snapshot) {
                    track.push({
                        session : snapshot.key,
                        timestamp : date,
                        texte : inputValue,
                        type : 'msg',
                        model:'msg',
                        name: snapshot.val().name,
                        lu: 0
                    });

                    database.ref('SESSION/'+Cookies.get('session')).update({
                        dateUpdate: date
                    })
                });


                jQuery(this).val("");
                return false;
            }
        });



        $body.on('click', '#wp-live-chat-header',  function(e) {
            e.stopPropagation();
            if($(this).hasClass('active')){
                $(this).removeClass('active');
                $('.chatbox').addClass('chatbox--closed');
            }else{
                $(this).addClass('active');
                $('.chatbox').removeClass('chatbox--closed');
            }
        });
        $body.on('click', '.chatbox__title__close', function(e) {
            e.stopPropagation();
            $('.chatbox').addClass('chatbox--closed');
            $('#wp-live-chat-header').removeClass('active');
        });


        // Soumission du formulaire
        $body.on('click', '.uk-submit-conversation', function (e) {
            e.preventDefault();
            var nom = jQuery('#inputName').val();
            var email = jQuery('#inputEmail').val();
            var date = new Date().getTime();

            if(nom !== '' && email !== ''){

                if(isValidEmailAddress(email)){
                    dataUpdate = {
                        name: nom,
                        email: email,
                        dateUpdate: date
                    };
                    database.ref('SESSION/'+Cookies.get('session')).update(dataUpdate);



                    if (!$.trim( $('.chatbox__body').html())){
                        track.push({
                            session : Cookies.get('session'),
                            timestamp : date,
                            texte : 'Hello  '+nom+ ', Que puis-je faire pour vous ?',
                            type : 'msg',
                            model:'auto',
                            name : nom,
                            lu: 0
                        });
                    }else{
                        track.push({
                            session : Cookies.get('session'),
                            timestamp : date,
                            texte : 'Le visiteur s\'est identifié',
                            type : 'track',
                            model: 'auto',
                            name : nom,
                            lu: 0
                        });
                    }


                    jQuery('.chatbox').removeClass('chatbox--empty');
                    jQuery('.chatbox__body').show();
                }else{
                    jQuery('#inputEmail').addClass('uk-form-danger')
                }

            }else{
                if(nom === ''){
                    jQuery('#inputName').addClass('uk-form-danger')
                }

                if(email === ''){
                    jQuery('#inputEmail').addClass('uk-form-danger')
                }
            }
        });

        function isValidEmailAddress(emailAddress) {
            var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
            return pattern.test(emailAddress);
        };

    });
})(jQuery);

