<?php

function menu($type) {

    require INCLUDES . 'content.inc';

    if ($type == 'navigation') {
        
        $offset = 1;
        $categories = count($content_tables);
        $sql = '';
        $option = '';
        
        // Get the value of the cookie if set
        
        if(isset($_COOKIE['navmenuitem'])){
            
            $menuvalue = $_COOKIE['navmenuitem'];
            
        }else{
        
            $menuvalue = 'pages';
            
        }

        foreach ($content_tables as $contenttype) {
        
            // Build the option for the content type

            $option .= '<button onclick="setnavitem(\''. $contenttype.'\'); document.location.reload(true);">'.$offset.'. '.ucfirst($contenttype).'</button> &nbsp;';
            $offset ++;
            
        }
        
        // Build the SQL statement for the menu item selected
        
        $sql = "SELECT id,title,'".$menuvalue."' AS contenttype FROM ".$menuvalue." WHERE status = 2 ORDER BY title;";
        
        // Get the result
        
        $result = mysql_fetchrows($sql);
        
        // Convert the array into HTML links
        
        $links = arraytolinks($result);
        
        $menu = '';

        $menu .= '<div class ="menu-' . $type . '">';
        $menu .= '<h2>' . ucfirst($type) . ' (' . $menuvalue.') - '.$categories.' categories</h2>';   
        $menu .= '<p>&nbsp;</p>';  
        $menu .= $option;
        $menu .= $links;
        $menu .= '</div>';

        return $menu;
        
    }elseif ($type == "global") {
        
        ?>

<div id="jquerymenu">
<ul id="top-menu-home">
  <li><a href="/">Home</a></li>
</ul>

<ul id="top-menu-pages">
  <li><a href="">Pages</a>
    <ul>
      <li><a href="/page/1">Page 1</a></li>
      <li><a href="/page/2">Page 2</a></li>
      <li><a href="/page/3">Page 3</a></li>
    </ul>
  </li>
</ul>

<ul id="top-menu-news">
  <li><a href="">News</a>
    <ul>
      <li><a href="/news/1">News 1</a></li>
      <li><a href="/news/2">News 2</a></li>
      <li><a href="/news/3">News 3</a></li>
    </ul>
  </li>
</ul>

<ul id="top-menu-faq">
  <li><a href="">FAQ's</a>
    <ul>
      <li><a href="/faq/1">FAQ 1</a></li>
      <li><a href="/faq/2">FAQ 2</a></li>
      <li><a href="/faq/3">FAQ 3</a></li>
    </ul>
  </li>
</ul>

<ul id="top-menu-user">
  <li><a href="/login.php">Login</a></li>
</ul>
</div>
        <?php
        
        
    }
}

