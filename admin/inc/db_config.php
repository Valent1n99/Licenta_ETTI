<?php


// Database connection details
$hname = 'localhost'; // Hostname (usually 'localhost')
$uname = 'root';      // Username (default is 'root' in XAMPP)
$pass = '';          // Password (default is empty in XAMPP)
$db = 'Hotel';       // Database name

// MySQL socket path (specific to macOS XAMPP)
$socket = '/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock';

// Create a connection
$con = mysqli_connect($hname, $uname, $pass, $db, null, $socket);

// Check the connection
if (!$con) {
    die("Cannot connect to the database: " . mysqli_connect_error());
} else {
    //echo "Connected successfully to the database.";
}





function filteration($data){
   foreach($data as $key => $value){
       $data[$key]=trim($value);
       $data[$key]=stripslashes($value);
       $data[$key]=htmlspecialchars($value);
       $data[$key]=strip_tags($value);
       $data[$key] = $value;
   }
   return $data;
}
function selectAll($table)
  {
    $con = $GLOBALS['con'];
    $res = mysqli_query($con,"SELECT * FROM $table");
    return $res;
  }
function select($sql,$values,$datatypes)
{
   $con = $GLOBALS['con'];
   if($stmt = mysqli_prepare($con,$sql)){
      mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
    if(mysqli_stmt_execute($stmt)){
       $res=mysqli_stmt_get_result($stmt);
       mysqli_stmt_close($stmt);
       return $res;
    }
   
     else{
      mysqli_stmt_close($stmt);
       die("Query cannot be executed - Select");
    }
    
   }
   else{
       die("Query cannot be prepared - Select");
   }

}
function update($sql,$values,$datatypes)
{
   $con = $GLOBALS['con'];
   if($stmt = mysqli_prepare($con,$sql)){
       mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
       if(mysqli_stmt_execute($stmt)){
           $res=mysqli_stmt_affected_rows($stmt);
           mysqli_stmt_close($stmt);
           return $res;
       }
   
     else{
           mysqli_stmt_close($stmt);
           die("Query cannot be executed - Update");
       }
   
   }
   else{
       die("Query cannot be prepared - Update");
   }

}

function insert($sql,$values,$datatypes)
  {
    $con = $GLOBALS['con'];
    if($stmt = mysqli_prepare($con,$sql))
    {
      mysqli_stmt_bind_param($stmt,$datatypes,...$values);
      if(mysqli_stmt_execute($stmt)){
        $res = mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
        return $res;
      }
      else{
        mysqli_stmt_close($stmt);
        die("Query cannot be executed - Insert");
      }
    }
    else{
      die("Query cannot be prepared - Insert");
    }
  }

  function delete($sql,$values,$datatypes)
  {
    $con = $GLOBALS['con'];
    if($stmt = mysqli_prepare($con,$sql))
    {
      mysqli_stmt_bind_param($stmt,$datatypes,...$values);
      if(mysqli_stmt_execute($stmt)){
        $res = mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
        return $res;
      }
      else{
        mysqli_stmt_close($stmt);
        die("Query cannot be executed - Delete");
      }
    }
    else{
      die("Query cannot be prepared - Delete");
    }
  }
?>