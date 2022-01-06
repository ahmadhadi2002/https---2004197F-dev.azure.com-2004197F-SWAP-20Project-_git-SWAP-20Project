<?php 
    $id = $_POST["updatecomment"];
    echo "<form action='/project/plan&comment/updatecomment.php' method='post'>";
    echo "<div class='commenttext'>";
    echo "Comment";
    echo "</div>";
    echo "<textarea class='commentarea' name='comment' rows= '4' cols='50' style='font:arial' placeholder='Comment'></textarea> <br><br>";
    echo "<button id='updatecomment1' name='updatecomment1' value='$id'>Submit</button></form>";
?>

<style>
    .commenttext{
        font-weight: bold;
        font-family: Arial, Helvetica, sans-serif;
        
    }

</style>


