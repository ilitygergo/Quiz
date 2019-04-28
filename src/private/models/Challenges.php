<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/etc/Database.php');

class Challenges{

    /**
     * @var int
     */
    private $challengeID;

    /**
     * @var int
     */
    private $hard;

    /**
     * @var mixed
     */
    private $time;

    /**
     * @var string
     */
    private $topic;

    /**
     * @var int
     */
    private $challengerID;

    /**
     * @var int
     */
    private $challengedID;

    /**
     * @var string
     */
    private $status;

    /**
     * Challenge constructor.
     */
    public function __construct()
    {
        $this->challengeID = null;
        $this->hard = null;
        $this->time = null;
        $this->topic = null;
        $this->challengerID = null;
        $this->challengedID = null;
        $this->status = null;
    }

    /**
     * @return int
     */
    public function getChallengeID()
    {
        return $this->challengeID;
    }

    /**
     * @param int $challengeID
     */
    public function setChallengeID($challengeID)
    {
        $this->challengeID = $challengeID;
    }

    /**
     * Erection enhancer
     * @return int
     */
    public function getHard()
    {
        return $this->hard;
    }

    /**
     * @param int $hard
     */
    public function setHard($hard)
    {
        $this->hard = $hard;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        $str = substr($this->time, 9, 10);
        return $str;
    }

    /**
     * @return string
     */
    public function getTimeFormal() {
        return $this->time;
    }

    /**
     * Time has to be added as YYYY-MM-DD string
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = 'TO_DATE(\'' . $time . '\',\'YYYY-MM-DD\')';
    }

    /**
     * @return string
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * @param string $topic
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;
    }

    /**
     * @return int
     */
    public function getChallengerID()
    {
        return $this->challengerID;
    }

    /**
     * @param int $challangerID
     */
    public function setChallengerID($challangerID)
    {
        $this->challengerID = $challangerID;
    }

    /**
     * @return int
     */
    public function getChallengedID()
    {
        return $this->challengedID;
    }

    /**
     * @param int $challengedID
     */
    public function setChallengedID($challengedID)
    {
        $this->challengedID = $challengedID;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status) {
        $this->status = $status;
    }

    /**
     * @param $challengeID
     */
    function getChallange($challengeID) {
        $sql = 'SELECT * FROM Challenges WHERE CHALLENGEID = \'' . $challengeID. '\'';
        $result = Database::query($sql);

        if ($row = oci_fetch_array($result)) {
            $this->setChallengeID($row[0]);
            $this->setHard($row[1]);
            $this->setTime($row[2]);
            $this->setTopic($row[3]);
            $this->setChallengerID($row[4]);
            $this->setChallengedID($row[5]);
            $this->setStatus($row[6]);
        }
    }

    /**
     * @param $time
     * @param $challenger
     * @param $challenged
     * @param $status
     * @return mixed
     */
    public function getSpecificChallenge($time, $challenger, $challenged, $status) {
        $sql = 'SELECT CHALLENGEID FROM Challenges WHERE TIME = TO_DATE(\'' . $time . '\', \'YYYY-MM-DD\')' .
        '  AND STATUS = \'' . $status . '\' AND CHALLENGER = ' . $challenger . ' AND CHALLENGED = ' . $challenged;
        $result = Database::query($sql);

        if ($row = oci_fetch_array($result)) {
            return $row[0];
        }

        return null;
    }

    /**
     * Saves the challenge to the database
     */
    public function saveChallenges() {
        $hard = $this->getHard();
        $time = $this->getTime();
        $topic = $this->getTopic();
        $challengerID = $this->getChallengerID();
        $challengedID = $this->getChallengedID();
        $status = $this->getStatus();

        if (!$this->validate()) {
            return;
        }

        $query = 'INSERT INTO Challenges values (NULL, ' . $hard . ', TO_DATE(\'' . $time . '\', \'YYYY-MM-DD\'),' .
            '\'' . $topic . '\',' . ' ' . $challengerID . ', ' . $challengedID . ', ' . '\'' . $status . '\')';

        Database::query($query);
    }

    /**
     * @return bool
     */
    public function validate () {
        try {
            $sql = 'SELECT CHALLENGEID FROM Challenges WHERE TIME = TO_DATE(\'' . $this->getTime() . '\', \'YYYY-MM-DD\')' .
                '  AND STATUS = \'' . $this->getStatus() . '\' AND CHALLENGER = ' . $this->getChallengerID() . ' AND CHALLENGED = ' . $this->getChallengedID();
            $result = Database::query($sql);

            if ($row = oci_fetch_array($result)) {
                throw new Exception("Már van aktív kihívásod a játékos ellen!");
            }

            return true;

        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
