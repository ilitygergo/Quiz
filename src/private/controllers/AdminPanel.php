<?php

class AdminPanel extends Controller
{
    private $userList;
    private $statisticsList;

    public function __construct()
    {
        $this->userList = null;
    }

    /**
     * @return mixed
     */
    public function getStatisticsList()
    {
        return $this->statisticsList;
    }

    /**
     * @param mixed $statisticsList
     */
    public function setStatisticsList($statisticsList)
    {
        $this->statisticsList = $statisticsList;
    }

    public function getUserList()
    {
        return $this->userList;
    }

    public function setUserList($userList)
    {
        $this->userList = $userList;
    }

    public function loadUserList(){
        $sql = "SELECT USERID,USERNAME
                FROM USR 
                WHERE ISADMIN = 0
                ORDER BY USERID ASC";
        $result = Database::query($sql);
        $array = null;
        while($row = oci_fetch_array($result,OCI_NUM)) {
            $array[$row[0]] = $row[1];
        }
        $this->setUserList($array);
    }

    public function printSelectUserList() {
        self::loadUserList();
        echo '<select class="w3-select" name="userid">';
            echo '<option value="" disabled selected>Usernames</option>';
            foreach (self::getUserList() as $id => $username){
                echo '<option value="'.$id.'">'.$username.' | USERID = '.$id.'</option>';
            }

        echo '</select>';
    }

    public function showActions(){
        echo '
        <div class="w3-display-container w3-round-large" style="
            position: relative;
            z-index: 1;
            background: #FFFFFF;
            max-width: 500px;
            top: 25%;
            margin:30px auto 100px ;
            padding: 45px;
            text-align: center;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);">
                <div class="w3-animate-top"> <h4>Select an action</h4></div>
                <hr/>
            <button class="w3-button w3-red w3-half"
            onclick="actionRedirect(1);">
                DELETE USER
            </button>
            <button class="w3-button w3-green w3-half"
            onclick="actionRedirect(2)">
                SHOW STATISTICS
            </button>
        </div>
        
        ';
    }

    public function deleteUserAction(){
        echo '<div class="w3-display-container w3-round-large" style="
            position: relative;
            z-index: 1;
            background: #FFFFFF;
            max-width: 500px;
            top: 25%;
            margin:30px auto 100px ;
            padding: 45px;
            text-align: center;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);">';
        echo '<div class="w3-animate-top"> <h4>Select a user to delete</h4></div>';
        echo '<form method="post" action="deleteUser">';
        $this->printSelectUserList();
        echo '<input type="submit" class="w3-margin-top w3-button w3-red" value="DELETE USER"><br/>';
        echo '</form>';
        echo '</div> ';
    }

    public function deleteUser($id){
        $sql = "DELETE FROM USR
                WHERE USERID = $id";
        Database::query($sql);
    }

    public function loadStatisticsList(){
        $sql = "SELECT topic,AVG(score) FROM RESULTS GROUP BY TOPIC ORDER BY AVG(score) DESC";
        $result = Database::query($sql);
        $array = null;
        while($row = oci_fetch_array($result,OCI_NUM)) {
            $array[$row[0]] = $row[1];
        }
        $this->setStatisticsList($array);
    }

    public function statisticsAction(){

        self::loadStatisticsList();

        echo '<table class="w3-table w3-border w3-bordered w3-centered w3-hoverable">';
        echo '<tr>';
        echo '<th>TOPIC</th>';
        echo '<th>AVERAGE SCORE</th>';
        echo '</tr>';

        foreach ($this->statisticsList as $topic => $avgScore){
            echo '<tr>';
            echo '<td>'.$topic.'</td>';
            echo '<td>'.$avgScore.'</td>';
            echo '</tr>';
        }

        echo '</table>';

    }

    public function printGoBackButton(){
        echo '<button class="w3-button w3-margin-top w3-blue-gray w3-wide w3-display-middle" onclick="actionRedirect(`back`)">';
        echo 'GO BACK</button>';
    }




}