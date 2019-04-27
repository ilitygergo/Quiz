<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/etc/Database.php');

class Has{

    /**
     * @var int
     */
    private $challengeID;

    /**
     * @var int
     */
    private $questionID;

    /**
     * Has constructor.
     */
    public function __construct()
    {
        $this->challengeID = null;
        $this->questionID = null;
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
     * @return int
     */
    public function getQuestionID()
    {
        return $this->questionID;
    }

    /**
     * @param int $questionID
     */
    public function setQuestionID($questionID)
    {
        $this->questionID = $questionID;
    }

    /**
     * @param $challengeID
     */
    function getHas($challengeID) {
        $sql = 'SELECT * FROM Has WHERE CHALLENGEID = \'' . $challengeID. '\'';
        $result = Database::query($sql);

        if ($row = oci_fetch_array($result)) {
            $this->setChallengeID($row[0]);
            $this->setQuestionID($row[1]);
        }
    }

    /**
     * Saves the has (challengeID, questionID) to the database
     */
    public function saveHas() {
        $challengeID = $this->getChallengeID();
        $questionID = $this->getQuestionID();

        $query = 'INSERT INTO Has values (' . $challengeID. ', ' . $questionID . ')' ;

        Database::query($query);
    }
}
