<?php

function MySQLConnction($task) {
	
	if($task == "open" || $task == ""){
		$host = "internal-db.s51258.gridserver.com";
		$user = "db51258";
		$pass = "3nc50Xj8y5";
		$db = "db51258_sgmscoreboard";
	
		$connection = mysql_connect($host, $user, $pass) or die ("<span class='error'>Unable to connect!</span>");
			
					/*socket connection*/
		//$connection = mysql_connect('localhost:/Applications/MAMP/tmp/mysql/mysql.sock', $user, $pass) 
		//	or die ("<span class='error'>Unable to connect!</span>");
		
				mysql_select_db($db) or die ("<span class='error'>Unable to select database!</span>"); 
	}
	
	if($task == "close") {
		if(isset($connection)){
			mysql_close($connection);
		}
	}
}

MySQLConnction("open");

$q = "SELECT * from scores ORDER BY score DESC";
$result = mysql_query($q) or die ("Error in query: $q. ".mysql_error()); 	
while($row = mysql_fetch_assoc($result)){
	$rows[] = $row;
}

?>


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="refresh" content="3600">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="stylesheet" type="text/css" href="css/test.css">
        <link rel="stylesheet" type="text/css" href="css/jquery.bxslider.css">
        <link rel="stylesheet" type="text/css" href="cash-assets/css/main.css">
        <link rel="stylesheet" type="text/css" href="cash-assets/css/logo.css">
        <style>
            #gallery{
                padding: 30px 0px 0px 0px; margin: 0;
                height: 750px;
                /*padding: 35px 20px 0px 40px;    */
                margin: 0;
                list-style: none;
                color: #fff;
                font: normal 122px Arial, sans-serif;
                width: 1000px;
                margin: 0 auto; 
            }
            #gallery li{ /*padding: 30px 20px 0px 40px;*/ }
            
            body{ color: #000; background: transparent url('http://bgarner.com/twitterscreen/px_by_Gre3g.png') top left repeat;}
            
            
        
/*            tr{ }
            td{ text-transform: uppercase; padding: 3px 5px;}
            td.team{ width: 250px;}
            td.score{text-align: right;}
            td.period{text-align: center; width: 150px; vertical-align: middle;}
            td.note{ font-size: 12px;  font-style: italic;}
            td.league{padding-right: 20px;}*/

/*            #time{ color: #999999;}*/
        </style>
    
    </head>

    <body background="#000000">
        <ul id="gallery">
	        <?php
	        $i = 1;
	        
	        foreach (array_chunk($rows, 3) as $score) {
	        	
	        ?>
	        	<li id='game<?=$i?>'>
	        		<table>
		        		<? foreach ($score as $s) { ?>
						<tr class='scorebar'>
							<td class="rank"> <?=$i?> </td>
		                    <td class='logo'>
		                       <span class='team-logo <?=$s['nick']?>'></span>
		                    </td>
		                    <td class='cityteam'>
		                        <span class='team-city'><?=$s['name']?>s</span>
		                        <span class='team-name'><?=$s['nick']?></span>
		                    </td>
		                    <td>
		                        <span class='score hscore'><?=$s['score']?></span>
		                    </td>
		                </tr>      	
						<? 
						$i++;
						} 
						?>		      		                
					</table>
				</li>
	        <?
		       
	        	
	        }
	        
	        ?>
	        
	        
        </ul>
        
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/modernizr.custom.43373.js"></script>
        <script type="text/javascript" src="js/jquery.bxslider.js"></script>

        <script type="text/javascript">
        $(document).ready(function()  
        {  
		            $("#gallery li").css("display","none"); //hide
                    $("#gallery li:first-child").css("display","block");
                    
                    setInterval(function(){
                     // console.log("looped");
                      $('#gallery li:first-child').fadeOut(500,  function(){
                        $(this).next('li').fadeIn(500).end().appendTo('#gallery');
                      });
                    }, 8000);
                    
                    
                    setTimeout(function(){
                    	//alert("reloading");
					    location.reload();
					  },72000);

        });

    
   


    
        </script>
        
    </body>

</html>