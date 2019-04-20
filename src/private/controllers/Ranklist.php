<?php

class Ranklist extends Controller {

    public function printRanklist(){

        require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/models/User.php');
        $sql_ranklist = "SELECT userID, SUM(score) FROM Results GROUP BY userID ORDER BY SUM(score) ASC";
        $result_ranklist = Database::query($sql_ranklist);
        $ranklist_array = null;

        while($row = oci_fetch_array($result_ranklist) != null){
            $ranklist_array[$row[0]] = $row[1];
        }

        foreach ($ranklist_array as $id => $score){
            $current_user = new User();
            $current_user->getUser($id);
            echo '<tr>';
            echo '<td>'.$current_user->getFirstName().'</td>';
            echo '<td>'.$current_user->getLastName().'</td>';
            echo '<td>'.$score.'</td>';
            echo '</tr>';
        }
    }
}
