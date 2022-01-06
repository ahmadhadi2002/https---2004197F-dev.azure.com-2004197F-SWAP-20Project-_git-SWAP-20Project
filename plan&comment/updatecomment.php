<!-- FORM MAKING --> 
<?php 
include 'config.php';

    session_start();

    if (!isset($_SESSION['updatecommentid'])){
        $id = $_POST['updatecomment'];
        $_SESSION['updatecommentid'] = $id;
    }
    else{
        $id = $_SESSION['updatecommentid'];
    }
    echo "<form action='/project/plan&comment/updatecomment.php' method='post'>";
    echo "<div class='commenttext'>";
    echo "Update comment";
    echo "</div>";
    echo "<textarea class='commentarea' name='comment' rows= '4' cols='50' placeholder='Comment'></textarea><br>";
    echo "<div id='errortext' class='errortext'>Please key in a comment</div><br>";
    echo "<button id='updatecomment1' name='updatecomment1' class='updatebutton1' value='$id'>Submit</button></form>";
?> 

<script>
    function show(){
        document.getElementById("errortext")
        .style.display="block";
    }
</script>

<style>
    .commenttext{
        font-weight: bold;
        font-family: Arial, Helvetica, sans-serif;
        
    }

    .commentarea{
        font-family: Arial, Helvetica, sans-serif;
        border: 0px, none
    }

    .updatebutton1{
        border-radius: 25px;
        background-color: lightgray;
        border-width: none;
        color: black;
        padding: 5px;
        height: 30px;
        width: 80px;
    }

    .errortext{
        color: red;
        display: none;
    }
</style>

<!-- SQL Statements -->
<?php
include 'config.php';

if (isset($_POST['updatecomment1'])){
    
    if (!empty($_REQUEST['comment'])){
            $id = $_POST['updatecomment1'];
            $comment = $con -> real_escape_string($_REQUEST["comment"]);
            $query = $con->prepare("UPDATE `comments` SET COMMENT=? WHERE ID=?");
            $query->bind_param("ss", $comment, $id);
            $result = $query->execute();
            echo $comment."<br>";
                if (!$result) {
                        echo "Error";
                        die();
                    }
                    
            echo "UPDATE SUCCESSFUL";
            unset($_SESSION['updatecommentid']);

            $log = "UPDATE `comments` SET COMMENT=$comment WHERE ID=$id";
            $fp = fopen('log.txt', 'a');
            fwrite($fp, "\n".$log);
            fclose($fp); 
            header("Location: http://localhost/project/plan&comment/getcomments.php");
        }
        else{
            echo "<script>";
            echo "show()";
            echo "</script>";
        }
}
    
?>
