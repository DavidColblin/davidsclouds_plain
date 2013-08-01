function bindbubble(){
    var y = {positionAt: "mouse",delayShow:"400", delayHide:"100"};

	$("#menu1").bubbletip( "#menu1bubbletip", y );
	$("#menu2").bubbletip( "#menu2bubbletip", y );
	$("#menu3").bubbletip( "#menu3bubbletip", y );
	$("#menu4").bubbletip( "#menu4bubbletip", y );
	}


function readcontent(content) {

$("#loader").css("display", "block");
$("#says").fadeOut(100, function a(){

$.get(content, function(d){  
           
            $("#loader").css("display", "none");
            $('#says').html(d);
     
$("#says").fadeIn(200); 
        
        }); //get ends  
    });  //fadeout ends

}//ends readcontent

