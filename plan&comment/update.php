<html>
<center>
<form action='/project/plan&comment/update.php' method='get'>
<input type='hidden' id='id' name='id' value='<?php echo $_GET['update'];?>'>
<label for='sdate'>Start Date:</label>
<input type='date' id='updateSDate' name='updateSDate'>
<label for='edate'>End Date:</label>
<input type='date' id='updateEDate' name='updateEDate'>
<label for='updateItem'>Item:</label>
<input id='updateItem' name='updateItem'>
<input type='submit' value='submit' name='submit'>
</form>
</html>
<?php
include 'config.php';
if(array_key_exists('submit', $_GET)){
    $query= $con->prepare("UPDATE planner SET `Start Date`=?, `End Date`=? , `Item`=? WHERE id=?");
    $sdate = $_GET["updateSDate"];
    $edate = $_GET["updateEDate"];
    $item = $_GET["updateItem"];
    $update = $_GET["id"];
  
    $query->bind_param('ssss',$sdate,$edate,$item,$update); //bind the parameters
    
    if ($query->execute()){
        header("Location: http://localhost/project/plan&comment/index.php");
        exit();
    }else{
        echo "Error executing query.";
    }
}
?>