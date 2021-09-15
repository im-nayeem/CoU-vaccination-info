<?php

/** ---function to connect with database--
* @return object $conn connection to database
*/
            function getDB()
            {
               $db_host="localhost"; //host server
               $db_name="cou_students";  //database name
               $db_user="nayeem"; //database user name
               $db_pass="(!4]1VCoztG2gM3u"; //pasword for $db_user

               $conn=mysqli_connect($db_host,$db_user,$db_pass,$db_name); 
                                 //get connection by mysqli_connect()

               if(mysqli_connect_error())  //if it can't connect to database print errors
                  {
                     echo "Connection Error!<br>";
                     exit;

                  }

               return $conn;  //id successfully connected then return object to connection
            } 
            //End of function to connect with database


//  mapping all of the DB entity name to formal name 
   $entity=["name"=>"Name","email"=>"E-mail","department"=>"Department","id"=>"ID","session"=>"Session","vaccinated"=>"Vaccinated","vaccination_id"=>"Vaccination ID","vaccine_name"=>"Vaccine Name","vaccination_date"=>"Vaccination Date","first_dose"=>"First Dose","second_dose"=>"Second Dose","fever"=>"Fever","headache"=>"Headache","vomitting"=>"Vomitting","other_effect"=>"Other Effects"];


/**---------Function to redirect to $url page------//
 * @param $url the url to redirect to
 */   function redirect($url) 
      {
            if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
                  $protocol = 'https';
            } else {
                  $protocol = 'http';
            }
            header("Location: {$protocol}://{$_SERVER['HTTP_HOST']}/{$url}");
            exit;
      }



 //mapping entity with table names
      $tables=["name"=>"student","email"=>"student","department"=>"student","id"=>"student","session"=>"student","vaccinated"=>"student","vaccination_id"=>"vaccination_info","vaccine_name"=>"vaccination_info","vaccination_date"=>"vaccination_info","first_dose"=>"vaccination_info","second_dose"=>"vaccination_info","fever"=>"side_effect","headache"=>"side_effect","vomitting"=>"side_effect","other_effect"=>"side_effect"];




/*--------Function to get table elements
* @param object connection to database
* @param string $sql sql query 
* @return array  - all elements found by sql query
*/

      function get_element($conn,$sql)
      {
          $result = mysqli_query($conn,$sql);
              if($result===false)
                  {
                      echo "Error!";
                      exit;
                  }
              return mysqli_fetch_all($result,MYSQLI_ASSOC);

      }



/**--------Function to Prepare SQL Statement to Insert Data in DB----//
 * @param object $conn connection to database
 * @param string $sql sql query  
 * @return object $stmt statement object or false if an error occurred.
 * */ function prepare_sql($conn,$sql)
       {
           $stmt=mysqli_prepare($conn,$sql);
           if($stmt===false)
               echo "Error!<br>";
           return $stmt;
       }

/**--------Function to Check if Statement is Executed Successfully---//
 * @param object $stmt statement object
 * @param object $conn connection to database
 * @return int 1 return 1 if statement executed successfully else return 0
 */ function is_success($stmt,$conn)
      {
      if(mysqli_stmt_execute($stmt))
                  return 1;
                else
                  echo "Error!<br>";
      return 0;
      }



//array containing all the department's name
$dept=["CSE","ICT","LAW","Mathematics","Physics","Chemistry","Pharmacy","Bangla","English","Public Administration","MCJ","Anthropology","Archaeology","Economics","Management System","AIS","Marketing","Finance & Banking"];

//array containing all sessions
$session = ["2014-2015","2015-2016","2016-2017","2017-2018","2018-2019","2019-2020"];


?>
