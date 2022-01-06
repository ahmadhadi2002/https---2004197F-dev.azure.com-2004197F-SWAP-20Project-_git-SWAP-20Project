<?php 

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<body>
<table>
    <tr><th><button class="editbtn" formaction="/project/plan&comment/index.php">Task planner</button></td></tr>
    <?php if ($_SESSION['user_role'] == 'admin'){
        echo " <tr><th><button class='editbtn' formaction='/project/projectdelon/manage_users_new.php' >Roles allocation</button> </td></tr>";} ?>
    <tr><th><button class="editbtn" formaction="/project/announcement/function/redirect.php">Announcement</button></td></tr>
</table>

</body>
</html>