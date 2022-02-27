<?php

namespace App\View\Components\Social;

use Illuminate\View\Component;

class Furniture extends Component
{
    public $furniture;
    public $url;

    public function __construct($furniture, $url)
    {
        $this->furniture = $furniture;
        $this->url = $url;
    }

    public function render()
    {
        return view('components.social.furniture');
    }
}
