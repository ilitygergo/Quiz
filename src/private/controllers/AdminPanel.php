<?php

class AdminPanel extends Controller
{
    private $userList;
    private $statisticsList;
    private $scienceTopPlayer;
    private $historyTopPlayer;
    private $literatureTopPlayer;
    private $technologyTopPlayer;
    private $geographyTopPlayer;

    public function __construct()
    {
        $this->userList = null;
    }

    /**
     * @return mixed
     */
    public function getScienceTopPlayer()
    {
        return $this->scienceTopPlayer;
    }

    /**
     * @param mixed $scienceTopPlayer
     */
    public function setScienceTopPlayer($scienceTopPlayer)
    {
        $this->scienceTopPlayer = $scienceTopPlayer;
    }

    /**
     * @return mixed
     */
    public function getHistoryTopPlayer()
    {
        return $this->historyTopPlayer;
    }

    /**
     * @param mixed $historyTopPlayer
     */
    public function setHistoryTopPlayer($historyTopPlayer)
    {
        $this->historyTopPlayer = $historyTopPlayer;
    }

    /**
     * @return mixed
     */
    public function getLiteratureTopPlayer()
    {
        return $this->literatureTopPlayer;
    }

    /**
     * @param mixed $literatureTopPlayer
     */
    public function setLiteratureTopPlayer($literatureTopPlayer)
    {
        $this->literatureTopPlayer = $literatureTopPlayer;
    }

    /**
     * @return mixed
     */
    public function getTechnologyTopPlayer()
    {
        return $this->technologyTopPlayer;
    }

    /**
     * @param mixed $technologyTopPlayer
     */
    public function setTechnologyTopPlayer($technologyTopPlayer)
    {
        $this->technologyTopPlayer = $technologyTopPlayer;
    }

    /**
     * @return mixed
     */
    public function getGeographyTopPlayer()
    {
        return $this->geographyTopPlayer;
    }

    /**
     * @param mixed $geographyTopPlayer
     */
    public function setGeographyTopPlayer($geographyTopPlayer)
    {
        $this->geographyTopPlayer = $geographyTopPlayer;
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
            max-width: 50%;
            top: 25%;
            margin:30px auto 100px ;
            padding: 45px;
            text-align: center;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);">
                <div class="w3-animate-top"> <h4>Select an action</h4></div>
                <hr/>
            <button class="w3-button w3-red w3-third"
            onclick="actionRedirect(1);">
                DELETE USER
            </button>
            <button class="w3-button w3-green w3-third"
            onclick="actionRedirect(2)">
                SHOW STATISTICS
            </button>
            <button class="w3-button w3-blue w3-third"
            onclick="actionRedirect(3)">
                INSERT QUESTIONS
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

    public function addQuestion($d,$t,$r,$w1,$w2,$w3,$q){
        $sql = "INSERT INTO Questions VALUES (NULL, '$d', '$t', '$r', '$w1', '$w2', '$w3', '$q.')";
        Database::query($sql);
        header("Location: AdminPanel");
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

    public function loadTopPlayers(){
        $sql = "SELECT SCORE,
                (SELECT USERNAME FROM USR WHERE USERID=RESULTS.USERID) AS USERNAME,
                 TOPIC FROM RESULTS
                  WHERE SCORE = (SELECT MAX(SCORE) FROM RESULTS WHERE TOPIC = 'science')";
        $result = Database::query($sql);
        while ($row = oci_fetch_array($result,OCI_NUM)){
            $tmp= null;
            $tmp[$row[1]] = $row[0];
            self::setScienceTopPlayer($tmp);
        }

        $sql = "SELECT SCORE,
                (SELECT USERNAME FROM USR WHERE USERID=RESULTS.USERID) AS USERNAME,
                 TOPIC FROM RESULTS
                  WHERE SCORE = (SELECT MAX(SCORE) FROM RESULTS WHERE TOPIC = 'literature')";
        $result = Database::query($sql);
        while ($row = oci_fetch_array($result,OCI_NUM)){
            $tmp= null;
            $tmp[$row[1]] = $row[0];
            self::setLiteratureTopPlayer($tmp);
        }

        $sql = "SELECT SCORE,
                (SELECT USERNAME FROM USR WHERE USERID=RESULTS.USERID) AS USERNAME,
                 TOPIC FROM RESULTS
                  WHERE SCORE = (SELECT MAX(SCORE) FROM RESULTS WHERE TOPIC = 'history')";
        $result = Database::query($sql);
        while ($row = oci_fetch_array($result,OCI_NUM)){
            $tmp= null;
            $tmp[$row[1]] = $row[0];
            self::setHistoryTopPlayer($tmp);
        }

        $sql = "SELECT SCORE,
                (SELECT USERNAME FROM USR WHERE USERID=RESULTS.USERID) AS USERNAME,
                 TOPIC FROM RESULTS
                  WHERE SCORE = (SELECT MAX(SCORE) FROM RESULTS WHERE TOPIC = 'geography')";
        $result = Database::query($sql);
        while ($row = oci_fetch_array($result,OCI_NUM)){
            $tmp= null;
            $tmp[$row[1]] = $row[0];
            self::setGeographyTopPlayer($tmp);
        }

        $sql = "SELECT SCORE,
                (SELECT USERNAME FROM USR WHERE USERID=RESULTS.USERID) AS USERNAME,
                 TOPIC FROM RESULTS
                  WHERE SCORE = (SELECT MAX(SCORE) FROM RESULTS WHERE TOPIC = 'technology')";
        $result = Database::query($sql);
        while ($row = oci_fetch_array($result,OCI_NUM)){
            $tmp= null;
            $tmp[$row[1]] = $row[0];
            self::setTechnologyTopPlayer($tmp);
        }

    }

    public function statisticsAction(){

        self::loadStatisticsList();
        self::loadTopPlayers();

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

        echo '<hr style="border:2px solid black;"/>';

        echo '<table class="w3-table w3-border w3-bordered w3-centered w3-hoverable">';
        echo '<tr>';
        echo '<th>TOPIC</th>';
        echo '<th>USERNAME</th>';
        echo '<th>MAX SCORE</th>';
        echo '</tr>';

        $tmp = null;

        $tmp = self::getScienceTopPlayer();
        echo '<tr>';
        echo '<td>SCIENCE</td>';
        if(!empty($tmp)) {
            echo '<td>' . key($tmp) . '</td>';
            echo '<td>' . $tmp[key($tmp)] . '</td>';
        } else {
            echo '<td> NO RESULTS </td>';
            echo '<td> NO RESULTS </td>';
        }
        echo '</tr>';

        $tmp = self::getGeographyTopPlayer();
        echo '<tr>';
        echo '<td>GEOGRAPHY</td>';
        if(!empty($tmp)) {
            echo '<td>' . key($tmp) . '</td>';
            echo '<td>' . $tmp[key($tmp)] . '</td>';
        } else {
            echo '<td> NO RESULTS </td>';
            echo '<td> NO RESULTS </td>';
        }
        echo '</tr>';

        $tmp = self::getHistoryTopPlayer();
        echo '<tr>';
        echo '<td>HISTORY</td>';
        if(!empty($tmp)) {
            echo '<td>' . key($tmp) . '</td>';
            echo '<td>' . $tmp[key($tmp)] . '</td>';
        } else {
            echo '<td> NO RESULTS </td>';
            echo '<td> NO RESULTS </td>';
        }
        echo '</tr>';

        $tmp = self::getLiteratureTopPlayer();
        echo '<tr>';
        echo '<td>LITERATURE</td>';
        if(!empty($tmp)) {
            echo '<td>' . key($tmp) . '</td>';
            echo '<td>' . $tmp[key($tmp)] . '</td>';
        } else {
            echo '<td> NO RESULTS </td>';
            echo '<td> NO RESULTS </td>';
        }
        echo '</tr>';

        $tmp = self::getTechnologyTopPlayer();
        echo '<tr>';
        echo '<td>TECHNOLOGY</td>';
        if(!empty($tmp)) {
            echo '<td>' . key($tmp) . '</td>';
            echo '<td>' . $tmp[key($tmp)] . '</td>';
        } else {
            echo '<td> NO RESULTS </td>';
            echo '<td> NO RESULTS </td>';
        }
        echo '</tr>';
        echo '</table>';
    }

    public function insertQuestionAction(){
        ?>

        <div class="w3-container w3-padding">
            <div class="w3-card-4">
                <div class="w3-center w3-padding-16 w3-blue">
                    <h2> INSERT A QUESTION </h2>
                </div>
                <div class="w3-margin w3-center">
                    <form method="post" action="insertQuestion">
                        <input class="w3-input" type="text" name="qu" title="question" required>
                        <label>QUESTION</label>

                        <input class="w3-input" type="text" name = "ra" title="right answer" required>
                        <label>Right Answer</label>

                        <input class="w3-input" type="text" name = "wa1" title="wrong answer" required>
                        <label>Wrong Answer</label>

                        <input class="w3-input" type="text" name = "wa2" title="wrong answer" required>
                        <label>Wrong Answer</label>

                        <input class="w3-input" type="text" name = "wa3" title="wrong answer" required>
                        <label>Wrong Answer</label>

                        <select class="w3-select" name="tp" title="category" required>
                            <option value="" disabled selected></option>
                            <option value="history">History</option>
                            <option value="geography">Geography</option>
                            <option value="technology">Technology</option>
                            <option value="literature">Literature</option>
                            <option value="science">Science</option>
                        </select>
                        <label>Topic</label>

                        <hr style="
                        border: 2px solid lightskyblue;
                        "/>

                        <h5>Difficulty</h5>
                        <input class="w3-radio" type="radio" name="ha" value="0" title="easy" checked/>
                        <label>Easy</label>

                        <input class="w3-radio" type="radio" name="ha" value="1" title="hard"/>
                        <label>Hard</label><br/>

                        <input type="submit" class="w3-button w3-wide w3-green w3-margin-top w3-margin-bottom"/>
                    </form>
                </div>
            </div>
        </div>

<?php
    }

    public function printGoBackButton(){
        echo '<button class="w3-button w3-margin-top w3-blue-gray w3-wide w3-center w3-bar" onclick="actionRedirect(`back`)">';
        echo 'GO BACK</button>';
    }




}