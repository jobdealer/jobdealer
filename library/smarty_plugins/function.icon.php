<?php

function smarty_function_icon($params, $smarty, &$repeat = false)
{
    $sLink  = '<a href="'.$params['href'].'"';
    if (isset($params['class'])) {
        $sLink .= ' class="'.$params['class'].'">';
    }
    $sLink .= '<span class="';

    switch($params['action']) {
        case 'edit':
            $sLink .= "icon page-white-edit";
            break;
        case 'delete':
            $sLink .= "icon cross";
            break;
        case 'detail':
            $sLink .= "icon information";
            break;
        case 'add':
            $sLink .= "icon add";
            break;
        case 'clone':
            $sLink .= "icon page-lightning";
            break;
    }

    $sLink .= '" title="'.$params['title'].'"/>';
    $sLink .= '</a>';
    return $sLink;
}
