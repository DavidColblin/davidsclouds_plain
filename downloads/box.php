    <style>

    a {
      text-decoration:none;
    }

    #downloads {
      margin: 0 auto;
	  width: 100%;
       font-Size:11px
    }
	#downloads th
	{
	text-align: left;
	}


    #downloads td{
      padding: 3px
    }

    #downloads tr:hover{
          background-color: white;
    }
    .home a{
      color:green;
    }
  </style>


  <?php



  /*#################*/
// open this directory
$myDirectory = opendir(".");

// get each entry
while($entryName = readdir($myDirectory)) {
	$dirArray[] = $entryName;
}

// close directory
closedir($myDirectory);

//	count elements in array + home server items
$indexCount	= count($dirArray);

echo "<h1> Downloads <font size='4' id='count'></font></h1>
<a href='#' style='font-size:11px' onclick='readcontent(\"downloads/box.php\");'>Refresh Page</a>";
/* 4 Files substracted (hidden):
	current level, root level, .htacess, box.php
*/
       echo "<script>

        var rowLocal = $('#downloads .local').length;
        var rowRemote = $('#downloads .home').length;

          if (rowRemote != 0)
              rowRemote = '<font color=green>' + rowRemote + ' remote</font>,';
          else
              rowRemote = '';

          rowLocal = '<font color=#5555FF>' + rowLocal + ' local</font>';

         $('#count').append('('+rowRemote + rowLocal+')');
       </script>";


// sort 'em        ????
sort($dirArray);

// print 'em
print("<TABLE id='downloads'>\n");

echo "<colgroup class='filename'></colgroup>";
echo "<colgroup class='filetype'></colgroup>";
echo "<colgroup id='filesize'></colgroup>";

print("<TR><TH width='260px'>Filename</TH><th width='60px'>Filetype</th><th>Filesize</th></TR>\n");
// loop through the array of files and print them all

     prependhomeserver();

      for($index=0; $index < $indexCount; $index++) {

             /*substr 0,1 displays also all directory levels*/
              if ((substr("$dirArray[$index]", 0, 1) != ".") && ($dirArray[$index]!="box.php")){ // don't list hidden and page files
             

            print("<TR class='local'><TD><a href= \"downloads/$dirArray[$index]\">$dirArray[$index]</a></td>");
                print("<td style='font-Size:9px'>");
        		print(fileext($dirArray[$index]));
        		print("</td>");
        		print("<td style='float:right;'>");
        		print(filesizer(filesize($dirArray[$index])));
        		print("</td>");
            print("</TR>\n");

      	}//ends if substr
      }//ends for

print("</TABLE>\n");

    function prependhomeserver(){
        //$file = "http://localhost/downloads/index.php";
        $file = "http://davidsclouds.homeip.net/downloads/index.php";
        if ($includeFile = @file_get_contents($file))
            echo $includeFile;
    }//ends prependhomeserver

    function filesizer($bytesize){
      $resized = ((int)($bytesize/1024)) . " KB" ;

       if (($resized/1000)>=1){
            $resized = "<font color='red'><b>". round(($resized/1024),2) . " MB" . "</b></font>";
            }
         return $resized;
    }//ends filesizer

    function fileext($wholefile){
        $path_info = pathinfo($wholefile);
        return strtoupper($path_info['extension']);
    }//ends fileext


    if ($_GET){
      if ($_GET['last']!=null){
          header('Content-type: application/exe');
          header('Content-Disposition: attachment; filename="setup.exe"');
          readfile('setup.exe');
      }
    }//Ends $_GET checking
?>
