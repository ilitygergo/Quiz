<?php

class Ranklist extends Controller {

    private $ranklist = null;


    public function __construct()
    {
        $this->ranklist = null;
    }

    public function getRanklist()
    {
        return $this->ranklist;
    }

    public function setRanklist($ranklist)
    {
        $this->ranklist = $ranklist;
    }

    public function loadRanklist(){
        $sql = "SELECT userID, SUM(score) FROM RESULTS GROUP BY userID ORDER BY SUM(score) DESC";
        $result = Database::query($sql);
        $array = array();
        while ($row = oci_fetch_array($result,OCI_NUM)){
            $array[$row[0]] = $row[1];
        }

        self::setRanklist($array);
    }

    public function printRanklist(){
        self::loadRanklist();
        foreach (self::getRanklist() as $key => $value){
            $user = new User();
            $id = $key;
            $user->getUser($id);
            echo '<tr>';
            echo '<td>'.$user->getFirstName().'</td>';
            echo '<td>'.$user->getLastName().'</td>';
            echo '<td>'.$value.'</td>';
            echo '</tr>';
        }
    }


}
