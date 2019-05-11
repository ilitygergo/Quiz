<?php

class Played extends Controller
{

    private $userID;
    private $enemy;
    private $hard;
    private $time;
    private $topic;
    private $challengesArray;


    public function __construct($userID)
    {
        $this->setUserID($userID);
    }

    /**
     * @return mixed
     */
    public function getChallengesArray()
    {
        return $this->challengesArray;
    }

    /**
     * @param mixed $challengesArray
     */
    public function setChallengesArray($challengesArray)
    {
        $this->challengesArray = $challengesArray;
    }


    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param mixed $userID
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    /**
     * @return mixed
     */
    public function getEnemy()
    {
        return $this->enemy;
    }

    /**
     * @param mixed $enemy
     */
    public function setEnemy($enemy)
    {
        $this->enemy = $enemy;
    }

    /**
     * @return mixed
     */
    public function getHard()
    {
        return $this->hard;
    }

    /**
     * @param mixed $hard
     */
    public function setHard($hard)
    {
        $this->hard = $hard;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @return mixed
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * @param mixed $topic
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;
    }

    public function loadChallenges()
    {
        $sql = "SELECT *
                FROM CHALLENGES
                WHERE (CHALLENGES.STATUS = 'inactive')
                AND (CHALLENGED = ".$this->getUserID()."
                OR CHALLENGER = ".$this->getUserID().")";

        $result = Database::query($sql);
        $array = null;
        $i = 0;

        while ($row = oci_fetch_array($result, OCI_BOTH)){
            $tmp = new self($this->getUserID());
            $row["HARD"] == 1 ? ($tmp->setHard(true)) : ($tmp->setHard(false));
            $tmp->setTime($row["TIME"]);
            $tmp->setTopic($row["TOPIC"]);
            $row[4] == $this->getUserID() ? ($tmp->setEnemy($row[5])) : ($tmp->setEnemy($row[4]));
            $array[$i] = $tmp;
            $i++;
        }

        $this->setChallengesArray($array);
    }

    public function printChallenges(){
        self::loadChallenges();
        if(!empty(self::getChallengesArray())){
            foreach (self::getChallengesArray() as $challange){
                $enemy = new User();
                $enemy->getUser($challange->getEnemy());
                echo '<tr>';
                echo '<td>'.$enemy->getUserName().'</td>';
                echo '<td>'.$challange->getTime().'</td>';
                echo '<td>'.$challange->getTopic().'</td>';
                if($challange->getHard()){
                    echo "<td>YES</td>";
                } else {
                    echo "<td>NO</td>";
                }
            }
        }

    }






}