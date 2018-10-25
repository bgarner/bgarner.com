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
                padding: 0; margin: 0;

                list-style: none;
                color: #fff;

				position: relative;
				left: 20px;

            }
            #gallery li{ /*padding: 30px 20px 0px 40px;*/ }
            
            body{ padding: 0; margin: 0; color: #000; background: transparent url('http://bgarner.com/twitterscreen/px_by_Gre3g.png') top left repeat; font-family: sans-serif;}
            
			.logo{ width: 150px; float: left;}
			.team-logo { height: 150px; width: 150px; display: block; position: relative; left: 20px; }
			            
            div.scorepage { list-style: none; font-size: 12px; }
            .teampage{ float: left;  font-size: 12px; width: 380px; height: 150px; padding: 0px 22px; 
	            
	                      background: #565656; /* Old browsers */
    background: -moz-linear-gradient(top, #565656 0%, #262626 100%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#565656), color-stop(100%,#262626)); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top, #565656 0%,#262626 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top, #565656 0%,#262626 100%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top, #565656 0%,#262626 100%); /* IE10+ */
    background: linear-gradient(to bottom, #565656 0%,#262626 100%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#565656', endColorstr='#262626',GradientType=0 ); /* IE6-9 */  
    
    	border-left: 1px solid black;
    	border-right: 1px solid black;
	            
            }
			.rank{ font-size: 40px; float: left; position: relative; top: 30px; color: #999;}
			.score{ font-size: 50px; float: right; position: relative; top: 30px;}
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
	        	
	        	
	        		<div class="scorepage">
						<? foreach ($score as $s) { ?>
	        			<span class="teampage">
		        			<span class="rank"><em>#<?=$i?></em></span>
		        			<span class="logo">
		        				<span class='team-logo <?=$s['nick']?>'></span>
		        			</span>
<!-- 		        			<span class="name"><?=$s['name']?>s <?=$s['nick']?></span> -->
		        			<span class="score"><?=$s['score']?></span>
	        			</span>
	        			<? 
						$i++;
						} 
						?>
	        		</div>

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