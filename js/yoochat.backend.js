var textarea = document.querySelector('textarea');
var reply = jQuery('.reply');
var message = jQuery('.message');

textarea.addEventListener('keydown', autosize);

function autosize(){
    var el = this;
    setTimeout(function(){
        el.style.cssText = 'height:auto; padding:0';
        // for box-sizing other than "content-box" use:
        // el.style.cssText = '-moz-box-sizing:content-box';
        el.style.cssText = 'height:' + el.scrollHeight + 'px';

        if (el.scrollHeight > 50){
            newHeight = 60 + (el.scrollHeight - 37);
            reply.css('height', newHeight);

            newHeightC = 260 + (el.scrollHeight - 37);
            message.css('height', 'calc(100vh - '+newHeightC+'px)');
        }else{
            newHeight = 60;
            reply.css('height', newHeight);

            newHeightC = 260;
            message.css('height', 'calc(100vh - '+newHeightC+'px)');
        }

    },0);
}



jQuery('.newMessage-back').on('click', function(e){
    e.preventDefault();
    jQuery('.side-two').removeClass('side-show');
});




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


var user_admin = database.ref('ADMIN');
var session = database.ref('SESSION');
var track = database.ref('MESSAGE');



var currentDate = new Date();


// evenement au click du remplissage du rapport
jQuery('#open-side-two').on('click', function(e){
    e.preventDefault();
    // if(jQuery('.side-two').hasClass('side-show')){
    //     jQuery('.side-two').removeClass('side-show');
    // }else{
    //     jQuery('.side-two').addClass('side-show');
    // }

    var $this = jQuery(this);
    var key = $this.data('key');

    var star_conver = database.ref('SESSION/'+key);

    star_conver.once('value').then(function (snapshot) {
        var childKeyParent = snapshot.key;
        var childDataParent = snapshot.val();
        if (childDataParent.name) {
            if(!jQuery('.side-two').hasClass('side-show')){
                jQuery('.side-two').addClass('side-show');
            }else{
                jQuery('.side-two').removeClass('side-show');
            }
        }else{
            if(jQuery('.side-two').hasClass('side-show')){
                jQuery('.side-two').removeClass('side-show');
            }
        }

    })


});


// evenement au click du bouton de connexion par l'opérateur en ligne

jQuery('body').on('click', '#connexion', function (e) {

    e.preventDefault();

    var $this = jQuery(this);
    var $login = jQuery(".uk-login");
    var connect = false;
    var date = new Date().getTime();

    // s'il n'a pas de cookies session
    if(!Cookies.get('adminSession')){

        // On verifie qu'il y'a pas une ancienne session de moin de 1 jour dans le navigateur pour le reconnecté tout simplement
        if (Cookies.get('OldadminSession')) {

            if(Cookies.get('ID_Admin') === data.current_user_id){
                dataUpdate = {
                    connect: 1,
                    dateUpdate: date,
                    dateConnect: date,
                    user_id : data.current_user_id,
                    name: data.current_user,

                };

                var oldSession = Cookies.get('OldadminSession');

                database.ref('ADMIN/'+oldSession).update(dataUpdate);

                Cookies.set('adminSession', oldSession, { expires: 0.5 });
                Cookies.set('OldadminSession', oldSession, { expires: 1 });
                Cookies.set('ID_Admin', data.current_user_id, { expires: 1 });

            }else{
                user_admin.once('value', function(snapshot) {
                    snapshot.forEach(function(childSnapshot) {

                        var childKey = childSnapshot.key;
                        var childData = childSnapshot.val();

                        if(childData.user_id === data.current_user_id){

                            database.ref('ADMIN/'+childKey).update({
                                connect: 1,
                                dateUpdate: date,
                                dateConnect: date,
                                user_id : data.current_user_id,
                                name: data.current_user,

                            });


                            Cookies.set('adminSession',childKey, { expires: 0.5 });
                            Cookies.set('OldadminSession', childKey, { expires: 1 });
                            Cookies.set('ID_Admin', data.current_user_id, { expires: 1 });
                        }

                    })
                });
            };


            connect = true;
        }

        // s'il n'a pas d'ancienne session, on cré le nouvel utilisateur dans la base
        if(connect === false){
            var admin = user_admin.push({
                user_id : data.current_user_id,
                dateConnect : date,
                name: data.current_user,
                connect: 1,
                dateUpdate: date
            });

            // on initialise les cookies dans le navigateur en cours
            Cookies.set('adminSession', admin.key, { expires: 0.5 });
            Cookies.set('OldadminSession', admin.key, { expires: 1 });
            Cookies.set('ID_Admin', data.current_user_id, { expires: 1 });
        }


    }else{
        // s'il ya un cookies sessions
        // on prend en compte l'etat du bouton connexion au moment du click
        // pour modifier l'etat de l'operateur en ligne et en local

        if ($this.data('state') === 0) {
            database.ref('ADMIN/'+Cookies.get('adminSession')).update({connect:1, dateUpdate:date});

        }else{
            database.ref('ADMIN/'+Cookies.get('adminSession')).update({connect:0, dateUpdate:date});
        }
    }
    // Modification de l'etat des informations en fonction de celle du bouton de connexion
    if ($this.data('state') === 0) {
        $this.data('state', 1);
        $this.text('Déconnexion');
        $login.text('(Connecté)').removeClass('uk-text-danger').addClass('uk-text-success');
        jQuery('#sideBar').fadeIn('slow');

    }else{
        $this.data('state', 0);
        $this.text('Connexion');
        $login.text('(Déconnecté)').removeClass('uk-text-success').addClass('uk-text-danger');
        jQuery('#sideBar').hide();
        Cookies.remove('adminSession');
        jQuery('#conversation').hide();
    }

    // initialisation du nombre d'operateur connecté
    count_admin();
});

jQuery('body').on('click', '.sideBar-body a', function (e) {
    e.stopPropagation();
});

jQuery('body').on('click', '.sideBar-body', function (e) {
    e.preventDefault();
    var $this = jQuery(this);
    var id = $this.attr('id');

    var date = new Date().getTime();

    jQuery('#conversation').hide().fadeIn('slow');
    jQuery('#comment').val("");

    jQuery('body').find('.sideBar-body').removeClass('uk-background-muted');

    var star_conver = database.ref('SESSION/'+id);

    star_conver.once('value').then(function (snapshot) {
        var childKeyParent = snapshot.key;
        var childDataParent = snapshot.val();

        var name;
        var mail;
        if(childDataParent.name){
            name = childDataParent.name;
            mail = '('+childDataParent.email+')';

            name = name +' '+mail;
        }else{
            name = 'Visiteur '+childKeyParent;
        }

        var dateChild = childDataParent.date;
        var DateConvert = new Date(dateChild);

        $this.addClass('uk-background-muted');

        jQuery('#conversation .heading-avatar-icon').html('<div class="img uk-text-uppercase">'+name.charAt(0)+'</div>');
        jQuery('#conversation .heading-name-meta').text(name);
        jQuery('#conversation .heading-online').text('Derniere Activité : '+DateConvert.getHours()+':'+DateConvert.getMinutes());
        jQuery('#conversation').data('key', childKeyParent);
        jQuery('#open-side-two').data('key', childKeyParent);



        jQuery('#conversation .message').html('<div class="uk-width-1-1 uk-margin message-previous"></div>');


        track.once('value', function (snapshot) {

            snapshot.forEach(function(childSnapshot) {

                var childKey = childSnapshot.key;
                var childData = childSnapshot.val();

                var dateChild = childData.timestamp;
                var DateConvert = new Date(dateChild);

                // jQuery('#'+childData.session).insertAfter(jQuery('#chatAfter'));

                if(childKeyParent === childData.session){

                    jQuery('#conversation').find('.heading-online').text('Derniere Activité : '+DateConvert.getHours()+':'+DateConvert.getMinutes());

                    if(childData.type === 'track'){
                        if(jQuery('#'+childKey).length === 0) {
                            if(childData.model === 'auto'){
                                jQuery('#conversation .message').append(
                                    jQuery('<div>').addClass('uk-width-1-1 uk-margin-small-bottom message-systeme').html(
                                        '<div class="systeme">\n' +
                                        '<small>'+DateConvert.getDate()+'/'+DateConvert.getMonth()+'/'+DateConvert.getFullYear()+' à '+DateConvert.getHours()+':'+DateConvert.getMinutes()+' :</small>\n' +
                                        ''+childData.texte+'\n' +
                                        '</div>'
                                    ).attr({'id' : childKey})
                                )
                            }else{

                                jQuery('#conversation .message').append(

                                    jQuery('<div>').addClass('uk-width-1-1 uk-margin-small-bottom message-systeme').html(
                                        '<div class="systeme">\n' +
                                        '<small>'+DateConvert.getDate()+'/'+DateConvert.getMonth()+'/'+DateConvert.getFullYear()+' à '+DateConvert.getHours()+':'+DateConvert.getMinutes()+' :</small>\n' +
                                        'Consulte la page <a href="'+childData.texte+'" target="_blank">'+childData.texte+'</a>\n' +
                                        '</div>'
                                    ).attr({'id' : childKey})
                                )

                            }
                        }
                    }

                    if(childData.type === 'msg' && !childData.user_id){
                        if(childData.lu === 0){
                            jQuery('#conversation .message').html('<div class="uk-width-1-1 uk-margin message-previous"></div>');
                            database.ref('MESSAGE/'+childKey).update({lu:1});
                            jQuery('#'+childKeyParent).find('.new-message').text(0).addClass('uk-hidden');
                        }else{
                            if(jQuery('#'+childKey).length === 0) {
                                if(childData.model === "auto"){
                                    jQuery('#conversation .message').append(
                                        jQuery('<div>').addClass('uk-width-1-1 uk-margin-small-bottom message-body uk-flex uk-flex-right').html(
                                            '<div class="message-main-sender">\n' +
                                            '<div class="sender">\n' +
                                            '<div class="message-text uk-margin-small-bottom">' + childData.texte + '</div>\n' +
                                            '<small class="message-time uk-float-right">' + DateConvert.getDate() + '/' + DateConvert.getMonth() + '/' + DateConvert.getFullYear() + ' à ' + DateConvert.getHours() + ':' + DateConvert.getMinutes() + '</small>\n' +
                                            '</div>\n' +
                                            '</div>\n'
                                        ).attr({'id': childKey})
                                    );
                                }else{

                                    jQuery('#conversation .message').append(
                                        jQuery('<div>').addClass('uk-width-1-1 uk-margin-small-bottom message-body uk-flex uk-flex-left').html(
                                            '<div class="message-main-receiver">\n' +
                                            '<div class="receiver">\n' +
                                            '<div class="message-text uk-margin-small-bottom">' + childData.texte + '</div>\n' +
                                            '<small class="message-time uk-float-right">' + DateConvert.getDate() + '/' + DateConvert.getMonth() + '/' + DateConvert.getFullYear() + ' à ' + DateConvert.getHours() + ':' + DateConvert.getMinutes() + '</small>\n' +
                                            '</div>\n' +
                                            '</div>\n'
                                        ).attr({'id': childKey})
                                    );
                                }
                            }
                        }

                    }

                    if(childData.type === 'msg' && childData.user_id){
                        if(jQuery('#'+childKey).length === 0) {
                            jQuery('#conversation .message').append(
                                jQuery('<div>').addClass('uk-width-1-1 uk-margin-small-bottom message-body uk-flex uk-flex-right').html(
                                    '<div class="message-main-sender">\n' +
                                    '<div class="sender">\n' +
                                    '<div class="message-text uk-margin-small-bottom">' + childData.texte + '</div>\n' +
                                    '<small class="message-time uk-float-right">' + DateConvert.getDate() + '/' + DateConvert.getMonth() + '/' + DateConvert.getYear() + ' à ' + DateConvert.getHours() + ':' + DateConvert.getMinutes() + '</small>\n' +
                                    '</div>\n' +
                                    '</div>\n'
                                ).attr({'id': childKey})
                            );
                        }

                    }
                }



            });

            jQuery("#conversation .message").stop().animate({ scrollTop: jQuery("#conversation .message")[0].scrollHeight}, 1);

        })

    });



});

// Instruction qui s'execute quand l'utilisateur est actif sur la page
if( ifvisible.now()){

    var $this = jQuery('#connexion');
    var $login = jQuery(".uk-login");
    var date = new Date().getTime();

    // verification que l'utilisateur a une session dans son navigateur en cour
    // pour faire des modifications de l'etat du bouton de connexion
    if(Cookies.get('adminSession') && Cookies.get('ID_Admin') === data.current_user_id){

        var starCountRef = database.ref('ADMIN/'+Cookies.get('adminSession'));
        starCountRef.once('value').then(function (snapshot) {
            if (snapshot.val().connect === 0){
                database.ref('ADMIN/'+snapshot.key).update({
                    connect: 1,
                    dateUpdate: date,
                    user_id : data.current_user_id,
                    name: data.current_user,

                });
                $this.data('state', 1);
                $this.text('Déconnexion');
                $login.text('(Connecté)').removeClass('uk-text-danger').addClass('uk-text-success');
                // affichage de la liste des utilisateurs connectés sur le site
                jQuery('#sideBar').fadeIn('slow');

            }
            // else{
                // database.ref('ADMIN/'+snapshot.key).child('connect').set(0);
                // database.ref('ADMIN/'+snapshot.key).child('dateUpdate').set(date);
            //     $this.data('state', 0);
            //     $this.text('Connexion');
            //     $login.text('(Déconnecté)').removeClass('uk-text-success').addClass('uk-text-danger');
            //     // Suppression de la liste des utilisateurs connectés sur le site
            //     jQuery('#sideBar').hide();
            //
            // }
        });
    }

    // initalisation du nombre d'operateur connecté
    count_admin();

    // Afichage en temp réel de la presence des utilisateurs sur le site web
    session.on('value', function(snapshot) {
        var count_visitor = 0;
        // jQuery('#sideBar').html('');

        snapshot.forEach(function(childSnapshot) {
            var childKey = childSnapshot.key;
            var childData = childSnapshot.val();

            var dateChild = childData.dateUpdate;
            var DateConvert = new Date(dateChild);

            if(childData.status === 1){

                var name;
                var mail;
                if(childData.name){
                    name = childData.name;
                    mail = '('+childData.email+')';

                    name = name +' '+mail;
                }else{
                    name = 'Visiteur '+childKey;
                }


                count_visitor++;
                if(jQuery('#'+childKey).length === 0){
                    jQuery('#sideBar').append(
                        jQuery('<div>').addClass('uk-grid-collapse sideBar-body uk-background-secondary').attr({ 'uk-grid' : '', 'id' : childKey}).append(
                            jQuery('<div>').html('<div class="col-width-auto sideBar-avatar"><div class="img uk-text-uppercase"> '+name.charAt(0)+' </div></div>'),
                            jQuery('<div>').addClass('uk-width-expand sideBar-name').html('<span class="name-meta uk-display-block uk-text-truncate">'+ name +' </span><span class="uk-display-block uk-text-truncate uk-link-tracking"><small>consulte le lien <a href="'+childData.page+'" target="_blank">'+childData.page+'</a></small></span>'),
                            jQuery('<div>').html('<div class="uk-width-auto sideBar-time"> <span class="time-meta">'+DateConvert.getHours()+':'+DateConvert.getMinutes()+'</span> <span class="uk-border-circle new-message uk-hidden">0</span></div>')
                        )
                    );

                }else{
                    jQuery('#'+childKey).find('.sideBar-avatar').html('<div class="img uk-text-uppercase">'+name.charAt(0)+' </div></div>');
                    jQuery('#'+childKey).find('.name-meta').text(name);
                }

            }
            else{

                if(childData.closed === 1){
                    jQuery('#'+childKey).fadeOut("normal", function() {
                        jQuery(this).remove();
                    });
                }


                // if(jQuery('#conversation').data('key') == childKey){
                //     jQuery('#conversation').hide();
                // }


            }
        });
        jQuery('.uk-visitor').text(count_visitor+' visiteur(s)');
    });


    function explode(){
        session.once('value', function(snapshot) {
            var count_visitor = 0;
            // jQuery('#sideBar').html('');

            snapshot.forEach(function(childSnapshot) {
                var childKey = childSnapshot.key;
                var childData = childSnapshot.val();

                var dateChild = childData.dateUpdate;
                var DateConvert = new Date(dateChild);
                var DateCreated = new Date(childData.date);



                if(childData.status === 0){

                    var today = new Date();
                    var diffMs = (today - DateConvert);

                    var diffMins = (diffMs / 1000 / 60);

                    if(diffMins > 3 && childData.closed !== 1){

                        dataUpdate = {
                            closed: 1
                        };
                        database.ref('SESSION/' + childKey).update(dataUpdate);

                        var nom = '';
                        if(childData.name){
                            nom = childData.name
                        }

                        track.push({
                            session : childKey,
                            timestamp : today.getTime(),
                            texte : 'le visiteur est parti du site internet',
                            type : 'track',
                            model:'auto',
                            name : nom,
                            lu: 1
                        });
                    }

                    // console.log(diffMins);


                }else{

                    var today = new Date();
                    var diffMs = (today - DateConvert);

                    var diffHours = (diffMs / 1000 / 60 / 60);
                    var diffMins = (diffMs / 1000 / 60);

                    if(diffMins > 60){

                        dataUpdate = {
                            closed: 1,
                            status: 0
                        };
                        database.ref('SESSION/' + childKey).update(dataUpdate);

                        var nom = '';
                        if(childData.name){
                            nom = childData.name
                        }

                        track.push({
                            session : childKey,
                            timestamp : today.getTime(),
                            texte : 'le visiteur est parti du site internet',
                            type : 'track',
                            model:'auto',
                            name : nom,
                            lu: 1
                        });
                        // console.log('supprime')
                    }

                    if(!childData.date && !childData.dateUpdate){
                        database.ref('SESSION/' + childKey).remove();
                    }

                    // console.log(DateCreated);
                    // console.log(DateConvert);
                    // console.log(diffHours);
                    // console.log(diffMins);
                    // console.log(childKey);

                }
            });
            // jQuery('.uk-visitor').text(count_visitor+' visiteur(s)');

        });
        // console.log('repeter')
    }
    setInterval(explode, 60 * 1000);


    // Tracking des actions de l'utilisateur sur le site web
    track.on('value', function (snapshot) {

        jQuery('#conversation .message').html('<div class="uk-width-1-1 uk-margin message-previous"></div>');

        var count_nonlu = 0;
        var myArray = {};

        snapshot.forEach(function(childSnapshot) {

            var childKey = childSnapshot.key;
            var childData = childSnapshot.val();

            var dateChild = childData.timestamp;
            var DateConvert = new Date(dateChild);

            jQuery('#'+childData.session).insertAfter(jQuery('#chatAfter'));

            if(jQuery('#conversation').data('key') === childData.session){

                var starCountRef = database.ref('SESSION/'+childData.session);
                starCountRef.once('value').then(function (snapshot) {
                    var name;
                    var mail;
                    if(snapshot.val().name){
                        name = snapshot.val().name;
                        mail = '('+snapshot.val().email+')';

                        name = name +' '+mail;
                    }else{
                        name = 'Visiteur '+snapshot.key
                    }

                    jQuery('#conversation').find('.heading-avatar-icon .img').text(name.charAt(0));
                    jQuery('#conversation').find('.heading-name-meta').text(name);
                });

                jQuery('#conversation').find('.heading-online').text('Derniere Activité : '+DateConvert.getHours()+':'+DateConvert.getMinutes());



                if(childData.type === 'track'){
                    if(jQuery('#'+childKey).length === 0){
                        if(childData.model === 'auto'){
                            jQuery('<div>').addClass('uk-width-1-1 uk-margin-small-bottom message-systeme').html(
                                '<div class="systeme">\n' +
                                '<small>'+DateConvert.getDate()+'/'+DateConvert.getMonth()+'/'+DateConvert.getYear()+' à '+DateConvert.getHours()+':'+DateConvert.getMinutes()+' :</small>\n' +
                                ''+childData.texte+'\n' +
                                '</div>'
                            ).attr({'id' : childKey}).insertAfter(jQuery('#conversation .message .uk-width-1-1:last-child'));
                        }else{

                            jQuery('<div>').addClass('uk-width-1-1 uk-margin-small-bottom message-systeme').html(
                                '<div class="systeme">\n' +
                                '<small>'+DateConvert.getDate()+'/'+DateConvert.getMonth()+'/'+DateConvert.getYear()+' à '+DateConvert.getHours()+':'+DateConvert.getMinutes()+' :</small>\n' +
                                'Consulte la page <a href="'+childData.texte+'" target="_blank">'+childData.texte+'</a>\n' +
                                '</div>'
                            ).attr({'id' : childKey}).insertAfter(jQuery('#conversation .message .uk-width-1-1:last-child'));

                        }
                    }



                }

                if(childData.type === 'msg' && !childData.user_id){
                    if(jQuery('#'+childKey).length === 0) {
                        if(childData.model === 'auto'){
                            jQuery('<div>').addClass('uk-width-1-1 uk-margin-small-bottom message-body uk-flex uk-flex-right').html(
                                '                            <div class="message-main-sender">\n' +
                                '                                <div class="sender">\n' +
                                '                                    <div class="message-text uk-margin-small-bottom">' + childData.texte + '</div>\n' +
                                '                                    <small class="message-time uk-float-right">' + DateConvert.getDate() + '/' + DateConvert.getMonth() + '/' + DateConvert.getYear() + ' à ' + DateConvert.getHours() + ':' + DateConvert.getMinutes() + '</small>\n' +
                                '                                </div>\n' +
                                '                            </div>\n'
                            ).attr({'id': childKey}).insertAfter(jQuery('#conversation .message .uk-width-1-1:last-child'));
                        }else{
                            jQuery('<div>').addClass('uk-width-1-1 uk-margin-small-bottom message-body uk-flex uk-flex-left').html(
                                '                            <div class="message-main-receiver">\n' +
                                '                                <div class="receiver">\n' +
                                '                                    <div class="message-text uk-margin-small-bottom">' + childData.texte + '</div>\n' +
                                '                                    <small class="message-time uk-float-right">' + DateConvert.getDate() + '/' + DateConvert.getMonth() + '/' + DateConvert.getYear() + ' à ' + DateConvert.getHours() + ':' + DateConvert.getMinutes() + '</small>\n' +
                                '                                </div>\n' +
                                '                            </div>\n'
                            ).attr({'id': childKey}).insertAfter(jQuery('#conversation .message .uk-width-1-1:last-child'));
                        }

                    }
                }

                if(childData.type === 'msg' && childData.user_id){
                    if(jQuery('#'+childKey).length === 0) {
                        jQuery('<div>').addClass('uk-width-1-1 uk-margin-small-bottom message-body uk-flex uk-flex-right').html(
                            '                            <div class="message-main-sender">\n' +
                            '                                <div class="sender">\n' +
                            '                                    <div class="message-text uk-margin-small-bottom">' + childData.texte + '</div>\n' +
                            '                                    <small class="message-time uk-float-right">' + DateConvert.getDate() + '/' + DateConvert.getMonth() + '/' + DateConvert.getYear() + ' à ' + DateConvert.getHours() + ':' + DateConvert.getMinutes() + '</small>\n' +
                            '                                </div>\n' +
                            '                            </div>\n'
                        ).attr({'id': childKey}).insertAfter(jQuery('#conversation .message .uk-width-1-1:last-child'));
                    }
                }

                database.ref('MESSAGE/'+childKey).update({
                    lu: 1
                });
            }

            var current_num = parseInt(jQuery('#'+childData.session).find('.new-message').text());


            if(childData.type === 'track'){
                if(childData.model == 'auto'){
                    jQuery('#'+childData.session).find('.sideBar-name .uk-link-tracking').html('<small>'+childData.texte+'</small>')
                }else{
                    jQuery('#'+childData.session).find('.sideBar-name .uk-link-tracking').html('<small>consulte le lien <a href="'+childData.texte+'" target="_blank">'+childData.texte+'</a></small>')
                }

                jQuery('#'+childData.session).find('.time-meta').html(DateConvert.getHours()+':'+DateConvert.getMinutes());
                if(current_num > 0){
                    jQuery('#'+childData.session).find('.new-message').removeClass('uk-hidden');
                }else{
                    jQuery('#'+childData.session).find('.new-message').addClass('uk-hidden').text(0);
                }
            }
            if(childData.type === 'msg' && !childData.user_id){

                if(childData.lu === 0 && jQuery('#conversation').data('key') !== childData.session)
                {
                    if(!myArray[childData.session]){
                        myArray[childData.session] = 1;
                        jQuery('#'+childData.session).find('.new-message').text(myArray[childData.session]).removeClass('uk-hidden');
                    }else{
                        myArray[childData.session] = myArray[childData.session] + 1;
                        jQuery('#'+childData.session).find('.new-message').text(myArray[childData.session]).removeClass('uk-hidden');
                    }

                }

                if(childData.model === 'auto'){
                    jQuery('#'+childData.session).addClass('uk-background-secondary');
                }else{
                    jQuery('#'+childData.session).removeClass('uk-background-secondary');
                }

                jQuery('#'+childData.session).find('.sideBar-name .uk-link-tracking').html('<small>'+childData.texte+'</small>');
                jQuery('#'+childData.session).find('.time-meta').html(DateConvert.getHours()+':'+DateConvert.getMinutes());

            }

            if(childData.type === 'msg' && childData.user_id){

                jQuery('#'+childData.session).removeClass('uk-background-secondary');
                jQuery('#'+childData.session).find('.sideBar-name .uk-link-tracking').html('<small>'+childData.texte+'</small>');
                jQuery('#'+childData.session).find('.time-meta').html(DateConvert.getHours()+':'+DateConvert.getMinutes());

            }

        });
        jQuery("#conversation .message").stop().animate({ scrollTop: jQuery("#conversation .message")[0].scrollHeight}, 1);


    });

}

// Envoie du message à l'utilisateur en ligne
jQuery("body").on("click", ".valid-send", function (e) {
    e.preventDefault();
    var inputValue = jQuery('#comment').val();
    var date = new Date().getTime();

    if(inputValue !== ''){
        var starCountRef = database.ref('SESSION/'+jQuery('#conversation').data('key'));
        starCountRef.once('value').then(function (snapshotParent) {

            var name = '';

            if(snapshotParent.val().name){
                name = snapshotParent.val().name;
            }

            track.push({
                session : jQuery('#conversation').data('key'),
                timestamp : date,
                texte : inputValue,
                type : 'msg',
                model:'msg',
                name : name,
                lu: 0,
                user_id: data.current_user_id
            });

            track.once('value', function (snapshot) {
                snapshot.forEach(function(childSnapshot) {

                    var childKey = childSnapshot.key;
                    var childData = childSnapshot.val();

                    if(childData.session === jQuery('#conversation').data('key')){
                        database.ref('MESSAGE/' + childKey).update({
                            lu:1
                        })
                    }
                });

            });

            starCountRef.update({
                user_id:data.current_user_id
            })
        });

        jQuery('#comment').val("");
    }



});

jQuery('<audio id="chatAudio"><source src="notify.ogg" type="audio/ogg"><source src="notify.mp3" type="audio/mpeg"><source src="notify.wav" type="audio/wav"></audio>').appendTo('body');

function count_admin(){

    var currentDate = new Date();

    var user_admin_count = database.ref('ADMIN');

    user_admin_count.once('value', function(snapshot) {
        var coun_user = 0;
        var $li;
        snapshot.forEach(function(childSnapshot) {

            var childKey = childSnapshot.key;
            var childData = childSnapshot.val();

            var hour = currentDate.getHours();
            var previousDate = currentDate.setHours(hour - 1);

            if(childData.connect === 1 && childData.dateUpdate >= previousDate){

                if(jQuery('li#'+childKey).length === 0) {

                    $li = jQuery('<li>').attr({'id': childKey}).append(
                        jQuery('<a>').attr('href', '#').append(
                            childData.name
                        )
                    )

                }
                coun_user++;
            }else{
                jQuery('li#'+childKey).fadeOut("normal", function() {
                    jQuery(this).remove();
                });
            }

            jQuery("#uk-nav").append($li)
        });
        jQuery('.heading-online.operateur').html(coun_user+' operateur(s) connecté(s) <span uk-icon="icon: triangle-down"></span>');

    });
}

var inFormOrLink = false;
jQuery('a').on('click', function() { inFormOrLink = true; });
jQuery('form').on('submit', function() { inFormOrLink = true; });
jQuery(document).on('keypress', function() { inFormOrLink = true; });

jQuery(window).on("beforeunload", function() {
    var date = new Date().getTime();
    if(Cookies.get('adminSession')) {
        var starCountRef = database.ref('ADMIN/'+Cookies.get('adminSession'));
        starCountRef.once('value').then(function (snapshot) {
            if (snapshot.val().connect === 1){
                dataUpdate = {
                    connect: 0,
                    dateUpdate: date
                };
                database.ref('ADMIN/' + Cookies.get('adminSession')).update(dataUpdate);
            }
        });

    }
});

