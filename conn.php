 <?php
 

 function fetch_quaquer_statement($result)
 {
     $array = array();

     if ($result instanceof mysqli_stmt) {
         $result->store_result();

         $variables = array();
         $data = array();
         $meta = $result->result_metadata();

         while ($field = $meta->fetch_field())
             $variables[] = &$data[$field->name];

         call_user_func_array(array($result, 'bind_result'), $variables);

         $i = 0;
         while ($result->fetch()) {
             $array[$i] = array();
             foreach ($data as $k => $v)
                 $array[$i][$k] = $v;
             $i++;
         }
     } elseif ($result instanceof mysqli_result) {
         while ($row = $result->fetch_assoc())
             $array[] = $row;
     }

     return $array;
 }
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "juliana";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 
 ?>