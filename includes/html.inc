<?php

/*
 * 
 * html.inc
 * Contains core html functions for our CMS
 * 
 */

function wraptag($tag, $text) {

    // Wraps $text with compliant tags
    // wraptag('p',sometext)
    // <p>sometext</p>

    return '<' . $tag . '>' . $text . '</' . $tag . '>';
}

/* Version 4 additions */

function div($divcontent, $class, $id = '') {

    // Generates a div tag $text with compliant tags
    // div('content','class')
    // <div class="class">content</div>
    // div('content','class','id')
    // <div class="class" id="id">content</div>
    // div('content','','id')
    // <div id="id">content</div>
    // div('content','','')
    // <div>content</div>

    if ($id != '') {

        $id = ' id="' . $id . '"';
    }

    if ($class != '') {

        $class = ' class="' . $class . '"';
    }

    return '<div' . $id . $class .'>' . 
    $divcontent . '</div>';
    
}

function ahref($text, $url, $title = '') {

    // Generates an href tag $text with compliant tags
    // ahref('Click here',freebsd.org)
    // <a href="http://freebsd.org" title="Click here">CLick here</a>
    // ahref('Click here',freebsd.org,'Link title')
    // <a href="http://freebsd.org" title="Link title">CLick here</a>

    if ($title == '') {
        
        $title = $url;
    }

    $ahref = '<a href="' . $url . '" title="' . $title . '">' . $text . '</a>';

    return $ahref;
}

function render($field){

    // Renders via template
    
    echo $field;
    
}
