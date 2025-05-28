<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SeoHead extends Component
{
    public $title;
    public $description;
    public $ogImage;

    public function __construct($title = 'Tonys Vinyl Förteckning', $description = 'En Samling Av Tonys Vinyler', $ogImage = '')
    {
        $this->title = $title;
        $this->description = $description;
        $this->ogImage = $ogImage;
    }

    public function render()
    {
        return view('components.seo-head');
    }
}
