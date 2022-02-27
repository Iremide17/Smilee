<?php

namespace App;

use App\Models\Application;

class NullApplication extends Application
{
    protected $attributes = [
        'name' => 'Default Name',
        'alias'=> 'Default alias',
        'email'=> 'default@gmail.com',
        'line1'=> '09066100815',
        'line2'=> '09066100815',
        'image'=> 'public/applications/smilee.png',
        'slogan'=> 'Default slogan',
        'motto'=> 'Default motto',
        'whatsapp'=> 'Default whatsapp',
        'facebook'=> 'Default facebook',
        'instagram'=> 'Default instagram',
        'address'=> 'Default address',
        'description'=> 'Default descrption',
        'terms'=> 'Default descrption',
        'policy'=> 'Default descrption',

    ];
}