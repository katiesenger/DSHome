<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php 
$location=$_POST['location'];
$action=$_POST['action'];
$port=$_POST['port'];
if ($port==""){$port="80";} 
//echo $location." ".$action." ".$port;
?>
<html>
<head>
<title>Raw port network sender</title>
</head>
<body>
<h4>Raw port machine</h4>
<p>A quick and dirty application by Jon Dron. Treat this code as public domain -
you can do anything you like with it!</p>

<p>Note that it is a little delicate - if there are any errors in what you type,
it will either hang or give you an obscure error code. Feel free to improve on 
it if you like and, if it seems useful, post your changes to the course wiki</p>
<?php 
if ($location==""){
 showform($action,$location,$port);
}else{
 showform($action,$location,$port);
 ?>
 <p> Port: <?php echo $port ?></p>
 <p> Location: <?php echo $location ?></p>
 <p> Last data sent: <?php echo $action ?> </p>
 <h4> Here are the results returned by the server: </h4> 
 <hr />
 <strong>
 <?php 
 $fp = fsockopen ($location, $port, $errno, $errstr, 30);
 if (!$fp) {
 	echo "$errstr ($errno)<br>\n";
 } else {
 	#echo "<p>Connection successfully made.
 	#  This is what the server returned...</p>"; 
 	fputs ($fp, $action);
 	#  echo nl2br(htmlentities(fgets ($fp,128)));
 	while (!feof($fp)) {
 		echo nl2br(htmlentities(fgets ($fp,128)));
 	}
 	fclose ($fp); 
 }
 ?> 
 </strong>
<?php 
}
 ?>
<hr />
<p>Raw port machine, &copy;Jon Dron, 2008</p>
</body>
</html>
<?php 
function showform($action,$location,$port)
{
?>
 <form action="rawport.php" method="post"> 
 <table summary="input form">
 <tr><td>Host::</td>
 <td>
    <input type="text" name="location" value="<?php echo $location ?>">
 </td></tr>
 <tr><td>
   Port: </td><td><p><input type="text" name="port" value="<?php echo $port ?>">
 </td></tr>
 <tr><td>Action:</td><td>
   <textarea name="action" cols="50" rows="6"><?php echo $action ?></textarea>
 </td></tr>
 </table>
 <p><input type="submit"></p> 
 </form>
<?php 
}
 ?>