<?php

namespace App\Http;

use App\Http\Middleware\CanEditYooChat;

use App\Http\Middleware\Panier;
use App\Http\Middleware\Promotion;
use TypeRocket\Http\Middleware\AuthAdmin;
use TypeRocket\Http\Middleware\AuthRead;
use TypeRocket\Http\Middleware\CanManageCategories;
use TypeRocket\Http\Middleware\CanManageOptions;
use TypeRocket\Http\Middleware\IsUserOrCanEditUsers;
use TypeRocket\Http\Middleware\OwnsCommentOrCanEditComments;
use TypeRocket\Http\Middleware\OwnsPostOrCanEditPosts;

class Kernel extends \TypeRocket\Http\Kernel
{
    protected $middleware = [
	    'hookGlobal' => [  AuthRead::class ],
        'resourceGlobal' =>
            [
                Middleware\VerifyNonce::class
            ],
        'noResource' =>
            [ AuthAdmin::class ],
        'user' =>
            [ IsUserOrCanEditUsers::class ],
        'post' =>
            [ OwnsPostOrCanEditPosts::class ],
        'page' =>
            [ OwnsPostOrCanEditPosts::class ],
        'comment' =>
            [ OwnsCommentOrCanEditComments::class ],
        'option' =>
            [ CanManageOptions::class ],
        'category' =>
            [ CanManageCategories::class ],
        'tag' =>
            [ CanManageCategories::class ],
        'yoochat' =>
            [ CanEditYooChat::class ],
        'promotion' => [],
        'not_promotion' => [ Promotion::class ],
	    'panier' => [],
	    'not_anier' => [ Panier::class ]
    ];
}
