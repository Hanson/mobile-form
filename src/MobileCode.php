<?php


namespace Hanson\MobileForm;


use Encore\Admin\Form\Field\Mobile;

class MobileCode extends Mobile
{

    protected $view = 'mobile-form::index';

    protected function formatAttributes(): string
    {
        $html = [];

        $this->attributes['class'] = 'form-control';

        foreach ($this->attributes as $name => $value) {
            $html[] = $name.'="'.e($value).'"';
        }

        return implode(' ', $html);
    }

}
