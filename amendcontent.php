<?php

require_once 'includes/cms.inc';
require INCLUDES . 'content.inc';
require INCLUDES . 'core.inc';
require INCLUDES . 'html.inc';
require INCLUDES . 'mysql.inc';

// SQL statements

$sql[0] = "SELECT COUNT(DISTINCT TABLE_NAME) FROM INFORMATION_SCHEMA.COLUMNS
           WHERE table_schema = 'freebsdcms'
           AND TABLE_NAME = '---P0---'";
$sql[1] = "SELECT TABLE_NAME,COLUMN_NAME,COLUMN_DEFAULT,IS_NULLABLE,DATA_TYPE,CHARACTER_MAXIMUM_LENGTH
           FROM INFORMATION_SCHEMA.COLUMNS
           WHERE table_schema = 'freebsdcms' 
           AND TABLE_NAME = '---P0---' 
           ORDER BY table_name, ordinal_position";
$sql[2] = "SELECT * FROM ---P0--- ORDER BY id DESC";         
$sql[3] = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'freebsdcms' AND TABLE_NAME = '---P0---'";         
$sql[4] = "SELECT `---P0---` FROM ---P1--- WHERE id ='---P2---'"; 

// The tables we will allow the user to edit via this form

$tables[] = "faqs";
$tables[] = "menus";
$tables[] = "news";
$tables[] = "pages";

// Fields that are automatically assigned via a default value in MySQL table definition

$skiplist[] = "id";
$skiplist[] = "timestamp";

///////////////////////////////////////////////////
///////////////////////////////////////////////////
///////////////////////////////////////////////////

// Check we are logged in

ifnotloggedin();

// Build the page up to the body tag

outfile(TEMPLATES . 'header.inc');

echo wraptag('title', 'Content Input');
echo HEAD;
echo BODY;
logoutform();

// Page control logic

if(isset($_POST["table"])){
    
    // User has not selected a table or we are testing their result

    $t = $_POST["table"];

    if (!in_array($t, $tables)) {
        
        // If the table is not on allowed list, bail to the first page
     
        build_page_1($tables);
    
    }else{
     
        // Check selected table is valid
     
        $s = $sql[0];
        
        // Replace the marker in the SQL statement with the cosen value 
        $s = str_replace ( '---P0---' , $t , $s );

        $result = mysql_select($s);
        $valid_table_count = $result['COUNT(DISTINCT TABLE_NAME)'];
     
        if($valid_table_count == 1){
            
            // Valid table selected - present form to edit data
            build_page_2($t,$sql,$skiplist);
        
        }else{
        
            // Send user to first page    
            build_page_1($tables);
        
        }

    }

}elseif(isset($_POST["update"])){   

    // Save the input. As we have not validated this, just display for now

    build_page_3($_POST);
    
}elseif(isset($_POST["id"])){   

    // Save the input. As we have not validated this, just display for now

    echo "Update old record";

}else{
        
    // Invalid value - return to start   
        
    build_page_1($tables);
    
}

///////////////////////////////////////////////////
///////////////////////////////////////////////////
///////////////////////////////////////////////////

function build_page_1($tables){

// HTML form definition

echo '<div id="content">';
echo '<div id="php">';
echo '<div id="h1">Select content</div>';
echo '<form action="amendcontent.php" method="post">';

// Build the list of tables

$tablecontrol = '';
$tablecontrol .= '<select name="table">';

foreach ($tables as $t){

  // $tables is an array - split each value out

  $tablecontrol .= '<option value="'.$t.'">'.$t.'</option>';

}

$tablecontrol .= '</select>';

// Build the edit options

$editcontrol = '';
$editcontrol .= '<input type="radio" name="inputmode" value="new" checked="checked">Add new content';
$editcontrol .= '<input type="radio" name="inputmode" value="update">Update current content';

// Build the submit option

$submitcontrol = '';
$submitcontrol .= '<input type="submit" value="Create content">';

// Add the DIV to format the controls

echo div($tablecontrol, 'formcontrol');
echo div($editcontrol, 'formcontrol');
echo div($submitcontrol, 'formcontrol');

// Complete the form

echo '</form>';
echo '</div></div>';
echo '<div id="licence">';
echo '<a href="licence.txt" title="Copyright and licence details">Copyright &copy; 2013 Rob Somerville me@merville.co.uk</a>';
echo '</div>';

}

function build_page_2($t,$sql,$skiplist){

// HTML form

echo '<div id="content">';
echo '<div id="php">';

// Check we have a valid inputmode

if(!isset($_POST["inputmode"])){
    
    echo "Error: Invalid inputmode";
    exit;

}else{


if($_POST["inputmode"] == "new" || (isset($_POST["rowid"]))){
    
     // New content - populate with selected value if we have arrived here
     // via an update content request.
     
     if(isset($_POST["rowid"])){

       $rowid = $_POST["rowid"];
       $populate = TRUE;
         
     }else{
     
       $rowid = "";
       $populate = FALSE;
         
     }

    
     echo '<div id="h1">Create new '.$t.' content</div>';
     echo '<form action="amendcontent.php" method="post">';

     // Get the schema for that particular table

     $s = $sql[1];
     $s = str_replace ( '---P0---' , $t , $s );

     $result = mysql_fetchrows($s);
     $divstart = '<div class="inputname">';
     $action = 'Save';
     
     echo '<input type="hidden" name="update" value="'.$t.'">';

     foreach($result as $row){
         
         // Loop through each field and build the form fields depending on the field type
         
        $field =  $row[1];
        $fieldtype =  $row[4];

       if (!in_array($field, $skiplist)) {

            if($fieldtype == "varchar"){
                
                $value = populatefields($sql[4],$field,$t,$rowid,$populate);
                            
                echo  $divstart . ucfirst($field).'</div><input class="varchar" type="text" name="' .$field. '" value="'.$value.'"><br />';
                
            }elseif($fieldtype == "int"){
            
                $value = populatefields($sql[4],$field,$t,$rowid,$populate);
            
                echo  $divstart . ucfirst($field).'</div><input class="int" type="text" name="' .$field. '" value="'.$value.'"><br />';                
            
            }elseif($fieldtype == "text"){
                
                $value = populatefields($sql[4],$field,$t,$rowid,$populate);
                
                echo  $divstart . ucfirst($field).'</div><textarea rows="10" cols="30" class="textarea" name="' .$field. '">'.$value.'</textarea><br />';

            }else{
            
                // Shouldn't get here
            
                echo 'Error field('.$field.')  '. $row[2].'|'. $row[3] .'|'.$row[4].'|'. $row[5] .'<br />';
            
            }
           
       }

    }

    //echo '</select>';        

    }elseif($_POST["inputmode"] == "update"){
        
     echo '<div id="h1">Select content '.$t.'</div>';
     echo '<form action="amendcontent.php" method="post">';  
     echo '<input type="hidden" name="table" value="'.$t.'">';
     echo '<input type="hidden" name="inputmode" value="new">';
     
     $s = $sql[3];
     
     // Replace the marker in the SQL statement with the chosen value 
     
     $s = str_replace ( '---P0---' , $t , $s );
     
     if($t == 'menus'){

      // DB schema is different
      // NB: Maximum cols = 3 unless mods to CSS performed

      $displaycols = array(2, 4, 5);      
           
     }else{

      // Everything else

      $displaycols = array(1, 2, 3);

     }
          
     // Get the field names for our table
     
     $titles = mysql_fetchrows($s);
     
     // Build the title row
     
     echo div('Select', 'tablehdr'); 
        
     foreach ($displaycols as $offset) {
    
        echo div($titles[$offset][0], 'tablehdr'); 
     
     }
   
     $s = $sql[2];
     $zebra = 0;
     $action = 'Update';   
        
     // Replace the marker in the SQL statement with the chosen value 
     $s = str_replace ( '---P0---' , $t , $s );

     $result = mysql_fetchrows($s);

     foreach($result as $row){

       if($zebra == 0){
       
        $class = 'tablerow1';
        $zebra = 1;
       
       }elseif($zebra == 1){

         $class = 'tablerow2';
         $zebra = 0;

       }
       
       // Radio button control
       
       $editcontrol = '<input type="radio" name="rowid" value="'.$row[0].'">';
             
        // Check formatting and output     
              
       formatcontentedit($row, $class, $displaycols, $editcontrol);
       
     }
         
    }else{

        echo "Error: Invalid inputmode";
        exit;
        
    }

}

// Finish form and add footer

echo '<input type="submit" value="'.$action.' '.$t.' item">';
echo '</form>';
echo '</div></div>';
echo '<div id="licence">';
echo '<a href="licence.txt" title="Copyright and licence details">Copyright &copy; 2013 Rob Somerville me@merville.co.uk</a>';
echo '</div>';

}

function build_page_3($post){
    
// HTML

echo '<div id="content">';
echo '<div id="php">';
echo '<div id="h1">Save content</div>';
echo '<ul>';  
    
foreach($post as $key => $value){
    
    // Just dump out values - we need to validate before adding to DB
    
    echo '<li><b>'.$key.'</b>: '.$value.'</li>';
    
} 

// End of form

echo '</ul><br />';  
echo '<a href="amendcontent.php">Return to add content</a>';

echo '</div></div>';
echo '<div id="licence">';
echo '<a href="licence.txt" title="Copyright and licence details">Copyright &copy; 2013 Rob Somerville me@merville.co.uk</a>';
echo '</div>';

}

function formatcontentedit($row, $class, $displaycols, $editcontrol){

    // Formats the rows from our select query in zebra format. 
    // To prevent the CSS from breaking due to NULL content 
    // and displays the appropriate rows as the menu schema is 
    // different from everything else.
         
    // Display the radio button

    echo div($editcontrol, $class);
    
    // Format each row
    
    foreach ($displaycols as $offset) {
    
        // First check we have some content - use a NBSP if NULL or blank
    
        if($row[$offset] == ''){
        
            $row[$offset] = '&nbsp;';
            
        }
        
        // Ensure length < 25 chars, else add elipses
        
        if(strlen($row[$offset]) > 25){
        
            $row[$offset] = substr($row[$offset],0,24) . ' ...';

        }
    
        // Display each field from the row
        
        echo div($row[$offset], $class);
                
    }
}

function populatefields($sql,$field,$t,$rowid,$populate){
                    
    if($populate){
        
      $s = str_replace ( '---P0---' , $field , $sql );
      $s = str_replace ( '---P1---' , $t , $s );
      $s = str_replace ( '---P2---' , $rowid , $s );
                                    
      $v = mysql_fetchrows($s);
                  
      $value = $v[0][0];
      
    }else{
    
      $value = "";
        
    } 
         
    return $value;   
    
}
