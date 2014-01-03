/*
	preload.js
	Provides Javascript support

 */

// Init routines

function preinit(){
    
    document.body.style.display = 'none'; 
    
}

function postinit(){
    
    $(document.body).fadeIn(500);
    
}

function globalmenu(){

    $(function() {$( "#top-menu-home" ).menu();});
    $(function() {$( "#top-menu-pages" ).menu();});
    $(function() {$( "#top-menu-news" ).menu();});
    $(function() {$( "#top-menu-faq" ).menu();});
    $(function() {$( "#top-menu-user" ).menu();});	

}

