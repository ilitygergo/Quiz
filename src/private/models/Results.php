<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/etc/Database.php');

class Results
{
    /**
     * @var int
     */
    private $resultsID;

    /**
     * @var int
     */
    private $score;

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
    private $userID;

    /**
     * Results constructor.
     */
    public function __construct()
    {
        $this->resultsID = null;
        $this->score = null;
        $this->hard = null;
        $this->time = null;
        $this->topic = null;
        $this->userID = null;
    }

    /**
     * @return int
     */
    public function getResultsID()
    {
        return $this->resultsID;
    }

    /**
     * @param int $resultsID
     */
    public function setResultsID($resultsID)
    {
        $this->resultsID = $resultsID;
    }

    /**
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param int $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    /**
     * Get hard goddamn it
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
     * @return mixed
     */
    public function getTime() {
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
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param string $userID
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    /**
     * @param $resultsID
     */
    function getResults($resultsID) {
        $sql = 'SELECT * FROM Results WHERE RESULTSID = \'' . $resultsID . '\'';
        $result = Database::query($sql);

        if ($row = oci_fetch_array($result)) {
            $this->setResultsID($row[0]);
            $this->setScore($row[1]);
            $this->setHard($row[2]);
            $this->setTopic($row[4]);
            $this->setUserID($row[5]);
        }

        $sql = 'SELECT to_char(TIME, \'yyyy-mm-dd\') FROM Results WHERE RESULTSID = \'' . $resultsID . '\'';
        $result = Database::query($sql);

        if ($row = oci_fetch_array($result)) {
            $this->setTime($row[0]);
        }
    }

    /**
     * Saves the result to the database
     */
    public function saveResults() {
        $score = $this->getScore();
        $hard = $this->getHard();
        $time = $this->getTime();
        $topic = $this->getTopic();
        $userID = $this->getUserID();

        $query = 'INSERT INTO Results values (NULL, ' . $score . ', ' . $hard .
            ', ' . $time . ' , \'' . $topic . '\', ' . $userID . ')';

        Database::query($query);
    }

}