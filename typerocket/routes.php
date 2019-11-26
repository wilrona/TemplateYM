<?php
/*
|--------------------------------------------------------------------------
| TypeRocket Routes
|--------------------------------------------------------------------------
|
| Manage your web routes here.
|
*/


tr_route()->get('/cron/facebook', 'webhook@Chatbot');



tr_route()->post('/campagne1/send', 'sendcampagne1@promotion');


tr_route()->post('/facture/send', 'register@panier');
tr_route()->get('/facture/qrcode', 'generateQRcode@panier');

