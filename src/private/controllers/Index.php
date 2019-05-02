<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/etc/Database.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/models/User.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/models/Challenges.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/models/Has.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/models/Questions.php');

class Index extends Controller {

    /**
     * @var User
     */
    private $user;

    /**
     * @var Challenges
     */
    private $challenges;

    /**
     * @var Challenges
     */
    private $has;

    /**
     * @var Questions
     */
    private $questions;

    /**
     * Index constructor.
     */
    public function __construct()
    {
        $this->user = new User();
        $this->challenges = new Challenges();
        $this->has = new Has();
        $this->questions = new Questions();
    }

    /**
     * @param $challenger
     */
    public function createChallenge($hardness, $topic, $challenger) {
        if(!$this->saveChallenge($hardness, $topic, $challenger)) {
            return;
        }

        $challengeID = $this->challenges->getSpecificChallenge(
            $this->challenges->getTime(),
            $this->challenges->getChallengerID(),
            $this->challenges->getChallengedID(),
            $this->challenges->getStatus()
        );

        if (!$challengeID) {
            return;
        }

        $questions = $this->saveQuestionsToHas($challengeID);

        $_SESSION["QUESTIONID"] = $questions;
        $_SESSION["CHALLENGEID"] = $challengeID;

        header("Location: game");
    }

    /**
     * @param $hardness
     * @param $topic
     * @param $challenger
     * @return bool
     */
    public function saveChallenge($hardness, $topic, $challenger) {
        $challenged = $this->user->getRandomUser($challenger);

        $this->challenges->setHard($hardness);
        $this->challenges->setTime(date("Y-m-d"));
        $this->challenges->setTopic($topic);
        $this->challenges->setChallengerID($challenger);
        $this->challenges->setChallengedID($challenged);
        $this->challenges->setStatus('active');

        if($this->challenges->validate()) {
            $this->challenges->saveChallenges();
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $challengeID
     * @return array
     */
    public function saveQuestionsToHas($challengeID) {
        $question = null;
        $stack = [];

        for ($x = 0; $x < 10; $x++) {
            $question = $this->questions->getRandomQuestion(
                $this->challenges->getTopic(),
                $stack,
                $this->challenges->getHard()
            );
            array_push($stack, $question);

            $this->has->setChallengeID($challengeID);
            $this->has->setQuestionID($question);
            $this->has->saveHas();
        }

        return $stack;
    }

    public function getChallengerNames($challenged) {
        $nameids = [];
        $names = [];
        $ret = '';

        $sql1 = 'SELECT CHALLENGER FROM Challenges WHERE CHALLENGED = ' . $challenged . ' AND STATUS = \'active\'' ;
        $result1 = Database::query($sql1);

        while ($row1 = oci_fetch_array($result1)) {
            array_push( $nameids, $row1[0]);
        }

        foreach ($nameids as $nameid) {
            $sql2 = 'SELECT USERNAME FROM Usr WHERE USERID = ' . $nameid ;
            $result2 = Database::query($sql2);

            if ($row2 = oci_fetch_array($result2)) {
                array_push( $names, $row2[0]);
            }
        }

        foreach ($names as $name) {
            $ret .= '<a class="dropdown-item" href="#" onclick="test()">' . $name . '</a>';
        }

        return $ret;
    }

}
