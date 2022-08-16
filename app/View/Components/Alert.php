<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $title;
    public $text;
    public $type;
    public $no;
    public $color;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $text, $title="", $no=0)
    {
        $types = ['error'=>'red', 'attention'=>'yellow', 'info'=>'grey', 'success'=>'green'];
        $this->no = $no;
        $this->type = strtolower($type);
        $this->title = empty($title) ? ucfirst($type) : $title;
        $this->text = ucfirst($text);
        $this->color = $types[$type];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
