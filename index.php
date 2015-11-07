<!DOCTYPE html>
<HTML>

<head>
	<meta charset="UTF-8">

 	<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.3.min.js"></script>

	<style>

		* {
			font-family: Arial;
			color:#454545;
			box-sizing: border-box;
		}
		.noselect,
        .noselect * {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-user-drag: none;
            user-drag: none;
            cursor: default;
            ;
        }
		body{
			margin:0;
			background-color:#F9F9F9;
		}
		.topSection{
			width:100%;
			height:40px;
			box-sizing: border-box;
			background-color:#454545;
			color:white;
			min-width: 300px;
		}

		.topSectionButtonContainer{
			float:right;
			width:150px;
			box-sizing: border-box;
			margin-right:40px;
		}
		.button{
			float:left;
			width:50px;
			height:40px !important;
			box-sizing: border-box;
			cursor:pointer;
			height:100%;
			text-align: center;	
			background-color: #454545;	
		}
		.button *{
			width:24px;
			height:24px;
			position:relative;
			top:7px;
			cursor:pointer;	
		}
		.button:hover{
			background-color: #7F7F7F;
		}	
		a[href], input[type='submit'], input[type='image'], label[for], select, button, .pointer {
		       cursor: pointer;
		}		
		.logoImage{
			float:left;
			box-sizing: border-box;
			height:90px;
			width:90px;
			position:absolute;
			left:5px;
			top:5px;	
		}
		.logo{
			padding:10px;
			margin-left:25px;
			font-family: Century Gothic, sans-serif;
			font-weight: bold;
			color:white;
			float:left;
		}

		.calendarContainer{
			box-sizing: border-box;
			display: inline-block;
			font-size: 0px;
		}
		.columnContainer{
			box-sizing: border-box;
			display: inline-block;
			font-size: 15px;
			float:left;
			width:80px;	
			border-style: solid;
			border-width: 1px;
			border-color: #FFF;	
		}
		.rowElement{
			box-sizing: border-box;
			display: inline-block;		
			width: 80px;
			height: 80px;
			float:left; 
			border-style: solid;
			border-width: 1px;
			border-color: #FFF;	
			background-color:#FDFDFD;
			color:#454545;
			padding-left:5px;	
		}
		.rowElement:hover{
			background-color:#FBFBFD;	
		}
		.hasFriendsNearby0{
			background-color:#CDFB51;	
		}
		.hasFriendsNearby0:hover{
			background-color:#BFFF12;	
		}		

		.DateSquare{
			cursor: pointer;
		}


		.prev,.next{
			background-color:#FFFBFD;
			color:#A5A5A5;
			cursor: pointer;
		}
		.currDay{
			font-weight: bold;
		}

		.myHeader{
			height:20px;
			background-color:#E9E9E9;
			color:white;
			border-style: solid;
			border-width: 1px;
			text-align: center;
			/*
			border-color: #454545;	
			text-align: center;
			padding-left:0;	
			*/
		}
		.myHeader:hover{
			background-color:#E9E9E9;
		}
		.mainSection{
			margin:10px;
			padding:10px;
			box-sizing: border-box;
		}
		.searchBoxContainer{
			height:30px;
			box-sizing: border-box;
			margin:10px;
			padding:4px;
			display: inline-block;
			width:250px;
			float:left;
			background-color:#FFF;
			border-radius:4px;
			border-style: solid;
			border-width: 1px;
			border-color: #E9E9E9;
		}
		.searchBox{
			color:#E9E9E9;
			font-size: 12px;
			font-style:italic;
			padding:2px;
		}
		.mainCalendarContainer{
			margin:10px;
			padding:10px;
			float:left;
			background-color:#FFF;
			border-radius:4px;
			border-style: solid;
			border-width: 1px;
			border-color: #E9E9E9;
			min-width: 585px;
			max-width: 585px;
		}
		.datePicker{
			width:100%;
			text-align: center;
		}

		.orangered{
			background-color: orangered;
		}
		.orangered:hover{
			background-color: orange;
		}

        .popupBackground {
            background-color: rgba(0,0,0,0.65);
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 80;
        }
        .popUpDayDetail {
            z-index: 90;
            left: 50%;
            position: absolute;
            margin-left: -40%;
            top: 100px;
            width: 80%;
            height:60%;
            background-color: #F8F8F8;
            border-radius: 3px;
            display: inline-block;
        }
        #map{
        	height:100%;
        	width:60%;
        	float:left;
        }
        #bananas{
        	display: inline;
        	color:yellow;
        	font-style: italic;
        }
        button{
        	background-image: none !important;
			border-style: solid;
			border-radius: 3px;
			margin: 10px;
			font-weight: bold;
			background-color: #454545;
			border-width: 1px;
			border-color: #454545;
			color: white;			
        }
        #selectedDateTitle{
		    min-width: 44%;
		    display: inline-block;
		    margin: 5px;
        }
		.newmessageBox{
			height:100px;
			width:200px;
			display: inline-block;
			position:absolute;
			top:40px;
			right:40px;
			background-color: white;
			border-style: solid;
			border-color: #E9E9E9;
			border-width:1px;
			border-radius:3px;
			color:#E9E9E9;
			padding:5px;
			font-style: italic;
			font-size: 12px;
		}
		.nextimage{
			height:10px;
			width:10px;
		}
		.previmage{
			height:10px;
			width:10px;
			  -webkit-transform: rotate(180deg);     /* Chrome and other webkit browsers */
			  -moz-transform: rotate(180deg);        /* FF */
			  -o-transform: rotate(180deg);          /* Opera */
			  -ms-transform: rotate(180deg);         /* IE9 */
			  transform: rotate(180deg);             /* W3C compliant browsers */			
		}		
		.filtercalendarIcon{
			position:relative;
			top:-17px;
			float:right;
		}

		/*Keep at the end*/
 		.hidden {
            display: none;
        }
	</style>
</head>
<body>

<script>

	$( document ).ready(function() {
    	console.log( "ready!" ); 
    	makeButtonclickable();  	
	});

	function makeButtonclickable(){
		$(".messagebutton").parent().click(function() {
  			$(".newmessageBox").toggleClass( "hidden" );
  			return false;
		});
	}

</script>

<div class="topSection">
	<div class="logo noselect">
		<img class="logoImage hidden" src="i/Blogo.png"/>
		Bananas <p id="bananas">)))))</p>
	</div>
	<div class="topSectionButtonContainer">
		<div class="button" title="Where is Everybody?">
			<img class="" src="i/international12.png"/>
		</div>
		<div class="button" title="My Schedule">
			<img class="" src="i/list98.png"/>
		</div>
		<div class="button orangered" title="My mails">
			<img class="messagebutton" src="i/new48.png"/>
		</div>			
	</div>
</div>
<div class="newmessageBox hidden">
	No new messages
</div>
<div class="mainSection">
	<div class="searchBoxContainer">
		<div class="searchBox">
			Filter Calendar
		</div>
		<img class="filtercalendarIcon" src="i/magnifier23.png"/>
	</div>

	<div class="mainCalendarContainer">
			<?php include 'calendar.php'; ?>
	</div>
</div>

<div class="popUpDayDetailContainer hidden">

<div>


<script src="https://maps.googleapis.com/maps/api/js"></script>
</body>
</HTML>