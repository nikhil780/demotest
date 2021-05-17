 <?php

 include 'connect.php';
   
                  
       $search = str_replace(' ', '%', $search_value);         

            $search = json_encode($search);

            $search_query = "";

            $search_query = "(credentials.credential_details LIKE '%$search%' OR credentials.username LIKE '%$search%') ";
            mysqli_query($con, $search_query);
            print($search_query)

?>