<style>.post{}

h1{
  margin: 10px;
}

.poster{
  display: inline;
  font-weight: bold;
}

.date{
  display: inline;
  font-size: 9px;
  padding-left: 10px;
}

.message{
  font-size: 11px;
  text-indent: 20px;
  margin-top: 0px;
}

#paginators{
  display: inline;
}

#paginators li{
  display: inline;
  padding: 2px;
}

#paginators i, #msgbox{
  font-size: 11px;
}

#paginators li:hover,#leaveMsg:hover,#msgbox .btn:hover {
  background: rgba(000, 255, 255, 0.4);
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
}

.postpage {
  display: none;
}

#leaveMsg{
  float: right;
  padding: 5px;
  text-shadow: 2px 2px 2px silver;
}

#submitbtn{
  float: right;
  padding: 5px 20px 5px;
  background: none;
  border: 2px solid white;
  font-weight: bold;
  font-size: 20px;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
}

#submitbtn:hover{
  background: aqua;
  cursor: pointer;
  text-shadow: 2px 2px 2px silver;
}

#msgbox .input{
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  border: 1px solid aqua;
  padding: 4px;
  text-shadow: 0px 0px 1px silver;
}

#msgbox{
  display:none;
}
#page1{
  display:block;
}


#msgbox table{
  margin: 0 auto;
}

#msgbox #disclaimer{
  font-size: 10px;
  color: grey;
  text-shadow: 0px 0px 1px silver;
}

#msgbox #alert{
  color: green;
}

#msgbox textarea {
  font: 12px tahoma;
}

label.error {    /* from jquery form validate plugin*/
  display: block;
  text-indent: 20px;
  font-size: 10px;
  color: red;
}
</style>

<h1>Message</h1>

 <?php
    include "scripts/db.php";
    $posts= @mysql_query("SELECT * FROM messages
                          WHERE msg_moderated = TRUE
                         ORDER BY msg_id DESC");

    //Variables
      $records= 0;
      $page =1;
      $paginators = "<ul id='paginators'><i>Pages:</i>";
      $recordsperpage = 4;   //to change if need more or less per page

    while( $post = @mysql_fetch_array($posts)){
                    if ($records == 0){  //beginning of new postpage
                        $paginators = $paginators . "<li class='btn' name='".$page."'>". $page . "</li>";
                        echo "<div id='page".$page."' class='postpage'>";
                    }
                          echo
                          "<span id='msg".$post['msg_id']."' class='post'>
                              <p class='poster'>".$post['msg_name']."</p><p class='date'>".$post['msg_date'].", ".$post['msg_time']."</p>
                              <p class='message'>".$post['msg_message']."</p>
                          </span>";

                    if ($records == ($recordsperpage-1)){ //ends a postpage
                        echo "</div>";
                        ++$page;
                        $records  = 0;
                    }else{
                    ++$records;
                    }
    }//ends while
    if (($records != $recordsperpage)||($records == 0))
        echo "</div>";    //in case it doesnt close if while loop broke before

     $paginators =  $paginators . "</ul><b class='btn' id='leaveMsg'>Leave a Message</b>";
     echo $paginators;
    @mysql_close($posts);


 ?>

 <script type="text/javascript" src="http://dev.jquery.com/view/trunk/plugins/validate/jquery.validate.js"></script>
 <script>
  
    $('#paginators li:first').css({"font-weight":"bold"});

    $('#paginators li').click(function(){

        $('#paginators li').css({"font-weight":"normal"});
        $(this).css({"font-weight":"bold"});

        $('.postpage').fadeOut().css({"display":"none"});
        $("#page" + $(this).attr('name')).slideDown().css({"display":"block"});

    });

    $('#leaveMsg').click(function(){
        $('.postpage,#paginators,#leaveMsg').slideUp(100);
        $('#msgbox').slideDown().css({"display":"block"});
    });

    $('#msgbox textarea').keyup(function(){
        var charlimit = 150;
        var box = ($(this).val()).length;

        box = charlimit - box;

        if (box < 0){
            $('#submitbtn').attr('disabled', 'disabled');
            $(this).html(($(this).val()).substring(0, str.length - 1)); //deletes last character
        }else{
            $('#alert').html('Characters left: '+ box);
            $('#submitbtn').removeAttr('disabled');
        }
    });

    $('#msgbox textarea').bind("keypress", function(e) {
        if (e.keyCode == 13) return false;  //enter
        if (e.keyCode == 39) return false; // quotes
        if (e.keyCode == 191) return false; // slash
        if (e.keyCode == 62) return false; // <
        if (e.keyCode == 60) return false; // >
    });


$('#msgform').validate({
       submitHandler: function() {
            var data=$("#msgform").serialize();
            $.post("scripts/postmsg.php",data,function(resp){
              $('#msgbox').hide();
              $('#thxmsg').show(1000).css({"display":"block"});   
            });//ends get
       }//ends submit handler
    });//ends form validate

  $('#msgform').submit(function() {
         return false; //disable form's postback
     });



 </script>

 <div id="msgbox">
    <h2>Leave A Message</h2>
    <?php
    @session_start();
    $messagecount = 3;
    if ((!isset($_SESSION['visitor'])) || (($_SESSION['visitor'])<$messagecount)){
      echo '
            <form id="msgform" action="" method="post">
                <table>

                    <tr><td>Name</td><td><input class="required input" minlength="3" maxlength="20" type="text" size="40" maxlength="100" name="name" placeholder="name"/></td></tr>
                    <tr><td>Email</td><td><input class="email input" size="40" maxlength="100" name="email" placeholder="email"/></td></tr>
                    <tr><td>Message</td><td><textarea class="input required" rows="3" cols="50" maxlength="150" name="message"></textarea></td></tr>
                    <tr><td colspan="2"><b id="alert"></b><input class="submit" id="submitbtn" type="submit" value="Post!"/></td></tr>

                </table>
            </form>
      ';  //ends echo
      }else{
        echo "<h1>Sorry!,</h1><h3 style='text-indent:160px'>you already sent $messagecount messages earlier today. Maybe you missed reading the bottom of page earlier?</h3>";
         }

    if ((isset($_SESSION['timer'])) &&(time() - $_SESSION['timer'] > 10800)) { //10800 seconds = 3hours
        session_destroy();
     }
    ?>
    <p id="disclaimer">
         <b>Please Read:</b>
            Messages are moderated may not be accepted and published. Messages are 150 characters long and 3 allowed every 3 hours. In case of longer message,
            please send an email to the given address at <u class='btn' onclick='readcontent("home.php");'>home</u>. Thank you.
    </p>


 </div><!--ends msgbox-->

 <div style="display:none" id='thxmsg'>
    <hr>
    <center><h1 style="text-shadow: 4px 4px 2px white"><p>Thanks for your message.<img src='graphics/D.png' alt="thx"/></h1></p><h3> It will be moderated soon!</h3></center>
    <a class="btn" onclick="readcontent('message.php');"> &lt back to messages</a>
 </div>
