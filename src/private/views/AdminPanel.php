<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/etc/menu.php');

?>

<script type="text/javascript">

    function actionRedirect(id){
        if(typeof id === "number" && id >= 0 && id <= 2){
            location.href = "AdminPanel?action=" + id;
        } else {
            location.href = "AdminPanel?action=0";
        }
    }

</script>

<style>
    .alert {
        padding: 20px;
    }

    .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    .closebtn:hover {
        color: black;
    }
</style>

<?php
if(isset($_GET['delSuccess'])){
    if($_GET['delSuccess'] == 1) {
        $msg = "User deleted successfully!";
        echo '<div class="alert w3-green w3-margin">';
        echo '<span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>';
        echo $msg;
        echo '</div>';
    }
}
$adminPanel = new AdminPanel();
if(isset($_GET['action'])){
    switch ($_GET['action']){
        case 0: $adminPanel->showActions(); break;
        case 1: $adminPanel->deleteUserAction(); $adminPanel->printGoBackButton(); break;
        case 2: $adminPanel->statisticsAction(); $adminPanel->printGoBackButton(); break;
        default : $adminPanel->showActions();
    }
} else {
    $adminPanel->showActions();
}

?>


