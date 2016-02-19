<?php
function deleteRow($table, $idColumn, $id)
{
  $user = "dsh";
  $pass = "dsh";
  try {
    $dbh = new PDO('mysql:host=localhost;dbname=DSHome', $user, $pass);
    $stmt = $dbh->prepare("DELETE FROM :table where :idColumn=:id");
    $stmt->bindParam(':table',$table);
    $stmt->bindParam(':idColumn',$idColumn);
    $stmt->bindParam(':id',$id);
    
    if ($stmt->execute()) {
      echo "<p class='debug'>$id deleted from $table</p>";
    }
    $dbh = null;
  }
  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
?>