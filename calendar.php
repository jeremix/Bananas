<?php
date_default_timezone_set('UTC');

if (isset($_GET['m'])) {   
  $requestedMonthDiff = $_GET['m'];
}else{
  $requestedMonthDiff = 0;
}



$requestedDateFull = date("Y-m", strtotime($requestedMonthDiff." months"));
$requestedYear = date("Y", strtotime($requestedMonthDiff." months"));
$requestedMonth = date("m", strtotime($requestedMonthDiff." months"));
$requestedDateFullText = date("F Y", strtotime($requestedMonthDiff." months"));

$currentDate = Date("Y-m");
$currentDay = Date("d");
$previousMonth = date("m", strtotime(($requestedMonthDiff-1)." months"));
$nDaysCurrent = cal_days_in_month(CAL_GREGORIAN, date("m", strtotime($requestedMonthDiff." months")), date("Y", strtotime($requestedMonthDiff." months")));
$nDaysPrevious = cal_days_in_month(CAL_GREGORIAN, $previousMonth, date("Y", strtotime($requestedMonthDiff." months")));

$firstDayOfCurrentMonth = $requestedDateFull.'-1';
$weekDayMonthStart = date('N', strtotime( $firstDayOfCurrentMonth));

$A=$nDaysPrevious;
$B=$nDaysCurrent;
$C=$weekDayMonthStart-1;

$M;
$x = 0;

$con = mysqli_connect("127.0.0.1", "jeremix", "Bn@n@s666", "bnanas");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}


//get all friends name->distance for entire month, put into map. use map in javascript to color tiles.
mysqli_query($con, "SET CHARACTER SET utf8");

if ($results = mysqli_query($con, "SELECT user.Id, user.FirstName, user.LastName, location.Name, location.lat, location.long, day_user_location.Date 
FROM user,location,user_location,day_user_location 
WHERE user.Id = user_location.user_Id 
    AND location.Id = user_location.location_Id 
    AND day_user_location.User_location_Id = user_location.Id 
    AND DATE_FORMAT(day_user_location.Date,'%Y-%m') = '".$requestedDateFull."'
    AND location_Id IN (
        SELECT Id 
        FROM location 
        WHERE Id IN (
                SELECT User_Location_Id 
                FROM day_user_location 
                WHERE Id IN (
                    SELECT day_user_location_Id 
                    FROM day_user_location_visibility 
                    WHERE User_Id = 2)))
")) {
  $num_rows = $results->num_rows;



class calendarFriendsLocation
{
  public $Id = '';
  public $FirstName = '';
  public $LastName = '';
  public $Name = '';
  public $Date = '';
  public $lat = '';
  public $long = '';
}

$fullResultsList = array();
$groupedResults = array();

  while($result = mysqli_fetch_array($results)) {
    $temp = new calendarFriendsLocation();
    $temp->Id = $result['Id'];
    $temp->FirstName = $result['FirstName'];
    $temp->LastName = $result['LastName'];
    $temp->Name = $result['Name'];
    $temp->Date = $result['Date'];
    $temp->lat = $result['lat'];
    $temp->long = $result['long'];    

    if(array_key_exists($temp->Date , $groupedResults )){
       $groupedResults[$temp->Date][]=$temp;
    }
    else{
      $aux[] = $temp;
      $groupedResults[$temp->Date] = $aux;
    }
  }
  if (!empty($groupedResults)){
    echo "<script> 
          var calendarFriendsLocation = JSON.parse('".json_encode($groupedResults)."');
          for (date in calendarFriendsLocation){
            $('#'+date).addClass('hasFriendsNearby0');
            console.log(calendarFriendsLocation);
            console.log(date);
          }
        </script>";
  }
}




$endofprevius = false;
$endofcurrent = false;
for($i=0;$i<6;$i++){
    for($j=0;$j<7;$j++){
        if(!$endofprevius){
            $day=$A-$C+$x+1;
            $month= date("m", strtotime(($requestedMonthDiff-1)." months"));
            $M[$i][$j][0]=$A-$C+$x+1;
            $M[$i][$j][1]='prev';
            $M[$i][$j][2]=$requestedYear.'-'.$month.'-'.$day;
            		//[2]=queryResultObject ??
            $x++;
            if($A-$C+$x == $A+1){
               $endofprevius = true; 
               $x = 1;
            }
        }
         if($endofprevius && !$endofcurrent){
            $day=$x;
            $month=$requestedMonth;
            $M[$i][$j][0]=$x;
            if(($currentDate == $requestedDateFull) && ($x == $currentDay)){
              $M[$i][$j][1]='currDay';
            }
            else{
              $M[$i][$j][1]='curr';
            }
            $M[$i][$j][2]=$requestedYear.'-'.$month.'-'.$day;
            $x++;
            if($x-1 == $B+1){
               $endofcurrent = true;
               $x = 1;
            }
        } 
         if($endofprevius && $endofcurrent){
            $day=$x;
            $month=date("m", strtotime(($requestedMonthDiff+1)." months"));        
            $M[$i][$j][0]=$x;
            $M[$i][$j][1]='next';
            $M[$i][$j][2]=$requestedYear.'-'.$month.'-'.$day;
            $x++;
        }          
    }
}
$W = array('Mon','Tue','Wed','Thu','Fri','Sat','Sun');
//<button onclick="window.location.href=\'http://localhost/bnanas/?m='.($requestedMonthDiff-1).'\'">p</button>'.

echo '<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.3.min.js"></script>
<div class="datePicker">
  <button onclick="changeMonth('.($requestedMonthDiff-1).');" title="Previous month"> <img class="previmage" src="i/play45.png"/>
  </button> &nbsp;<p id="selectedDateTitle" class="noselect">'. 
  
  $requestedDateFullText .

  '</p>&nbsp;<button onclick="changeMonth('.($requestedMonthDiff+1).');" title="Next month"> <img class="nextimage" src="i/play45.png"/>
  </button>
  </div>
  <div class="calendarContainer">';
  for($j=0;$j<7;$j++){
    echo '<div class="columnContainer">
      <div class="rowElement noselect myHeader">'
        .$W[$j].'
      </div>';
      for($i=0;$i<6;$i++){
      echo '<div id="'.$M[$i][$j][2].'" class="DateSquare noselect rowElement '.$M[$i][$j][1].'">
        '.$M[$i][$j][0].'
      </div> ';                     
      }
    echo '</div>';
  }
echo '</div>';
/*{{content['.$i.']['.$j.']}}*/
/*
$link = mysqli_connect("127.0.0.1", "jeremix", "Bn@n@s666", "bnanas");
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';
*/



$p1 = array("lat" => "38.5836479","lng" => "-7.9069337"); //Evora
$p2 = array("lat" => "48.8666667","lng" => "2.3333333"); // Paris

$km = distanceCalculation($p1, $p2, 2); // Calculate distance in kilometres (default)
//echo $km;
function distanceCalculation($point1, $point2, $decimals) {
  // Calculate the distance in degrees
  $degrees = rad2deg(acos((sin(deg2rad($point1['lat']))*sin(deg2rad($point2['lat']))) + (cos(deg2rad($point1['lat']))*cos(deg2rad($point2['lat']))*cos(deg2rad($point1['lng']-$point2['lng'])))));

  return round($degrees * 111.13384, $decimals);
}


?>
<script>
  function changeMonth(value){
    $('.mainCalendarContainer').load('calendar.php?m='+value);
  }

    function makeCalendarclickable(){

    $(".DateSquare").click(function() {
      //console.log(this.id);
      $(".popUpDayDetailContainer").toggleClass( "hidden" );
      $('.popUpDayDetailContainer').load('daydetail.php?d='+this.id);
      return false;
    });
  }
makeCalendarclickable();

    
</script>