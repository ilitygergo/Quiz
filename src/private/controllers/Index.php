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
    public function createChallengeAndQuestionList($hardness, $topic, $challenger) {
        $stack = [];
        $question = null;
        $challenged = $this->user->getRandomUser($challenger);

        //Creating the challenge
        $this->challenges->setHard($hardness);
        $this->challenges->setTime(date("Y-m-d"));
        $this->challenges->setTopic($topic);
        $this->challenges->setChallengerID($challenger);
        $this->challenges->setChallengedID($challenged);
        $this->challenges->setStatus('active');

        $this->challenges->saveChallenges();

        $challengeID = $this->challenges->getSpecificChallenge(
            $this->challenges->getTime(),
            $this->challenges->getChallengerID(),
            $this->challenges->getChallengedID(),
            $this->challenges->getStatus()
        );

        if (!$challengeID) {
            return;
        }

        //Updating the Has table with the questions
        for ($x = 0; $x <= 10; $x++) {
            $question = $this->questions->getRandomQuestion($topic, $stack, $hardness);
            array_push($stack, $question);

            $this->has->setChallengeID($challengeID);
            $this->has->setQuestionID($question);
            $this->has->saveHas();
        }

        header("Location: game");
    }

}
