/*
	postload.js
	Provides Javascript support

 */

// Call the function displaydate()

displaydate();

function displaydate(){

    // Displays the date and time in AM/PM format. 
 
    var currentTime = new Date()
    var hours = currentTime.getHours()
    var minutes = currentTime.getMinutes()
    var month = currentTime.getMonth() + 1
    var day = currentTime.getDate()
    var year = currentTime.getFullYear()
    
    if (minutes < 10){
        minutes = "0" + minutes
    }
    
    var ampm = "";
    
    if(hours > 11){
        ampm = "PM"
    } else {
        ampm = "AM"
    }
    
    document.write("<div class=\"jstime\">" + day + "/" + month + "/" + 
    year + " " + hours + ":" + minutes + ampm + "</div>")

}

// Set navigation menu cookie

function setnavitem(item){
    
    $.cookie("navmenuitem", item);
    
}