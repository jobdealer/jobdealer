<?php

function smarty_function_icon($params, $content, $smarty, &$repeat = false)
{
    $sLink  = '<a href="'.$params['href'].'">';
    $sLink .= '<span class="';

    switch($params['action']) {
        case 'edit':
            $sLink .= "icon page-white-edit";
            break;
        case 'delete':
            $sLink .= "icon cross";
            break;
    }

    $sLink .= '" title="'.$params['title'].'"/>';
    $sLink .= '</a>';
    return $sLink;
}