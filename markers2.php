<?php
    date_default_timezone_set('UTC');

    if (isset($_GET['d'])) {   
      $requestedDay = $_GET['d'];
    }else{
      $requestedDay = $currentDate = Date("Y-m-d");
    }

$con = mysqli_connect("127.0.0.1", "jeremix", "Bn@n@s666", "bnanas");
    if (!$con) {
        die('Could not connect: ' . mysql_error());
    }
    
    if ($results = mysqli_query($con, "SELECT user.FirstName, user.LastName, location.Name, location.lat, location.long, day_user_location.Date 
        FROM user,location,user_location,day_user_location 
        WHERE user.Id = user_location.user_Id 
            AND location.Id = user_location.location_Id 
            AND day_user_location.User_location_Id = user_location.Id 
            AND day_user_location.Date = '".$requestedDay."'
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
        echo '{
            "locations" : [';
        $x = 1;
        while($result = mysqli_fetch_array($results)) {
            echo '{
                    "title": "Aberystwyth University",
                    "web": "www.aber.ac.uk",
                    "phone": "+44 (0)1970 623 111",
                    "lat": "'.$result['lat'].'",
                    "lng": "'.$result['long'].'"
                }'; 
                if(mysqli_num_rows($results) <> $x){
                    echo ',';
                } 
                $x++; 
            }
        echo ']}';

        /* free result set */
        mysqli_free_result($results);
    }
    else{
        //echo 'fail';
    }

?>