 <?php

 

 include 'connect.php';
   
      

 
               $search_query = table('credentials')
                ->whereJsonContains('credential_details->username', ['doucument', 'port'])
                ->get();
                
            print($search_query)

 

?>