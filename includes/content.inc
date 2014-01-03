<?php

/*
 * 
 * content.inc
 * Defines content types for our CMS
 * 
 */
 
// Define the content type. This must match any tables defined in our 
// CMS
 
$content_types[] = 'page';
$content_types[] = 'faq';
$content_types[] = 'news';

// Map each content type to a table. Each content type must be matched
// to a corresponding table

$content_tables['page'] = 'pages';
$content_tables['faq'] = 'faqs';
$content_tables['news'] = 'news';
