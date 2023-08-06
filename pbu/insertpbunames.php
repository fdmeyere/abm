<html><body>
<?php
  include('../db_connection.php');

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pbuname = filter_var($_POST["pbuname"], FILTER_SANITIZE_STRING); 
    $derdencode = filter_var($_POST["derdencode"], FILTER_SANITIZE_STRING);     



    if (empty($pbuname)){
      die("Je moet een pad ingeven.");
    }
    
    if (empty($derdencode)){
      die("Je moet een derdencode ingeven.");
    }
    

$conn = OpenCon();

$sql = "INSERT INTO pbunames (derdencode, pbuname) VALUES ('$derdencode', '$pbuname')"; 

if ($conn->query($sql) === TRUE) {
  echo "De database " . $pbuname . " werd succesvol toegvoegd aan de lijst.";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


  }
?>
</body></html>