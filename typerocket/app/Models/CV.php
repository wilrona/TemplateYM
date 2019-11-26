<?php
namespace App\Models;


use TypeRocket\Models\WPPost;

class CV extends WPPost
{
	protected $postType = 'resume';
}