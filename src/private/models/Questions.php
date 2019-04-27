<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/etc/Database.php');

class Questions
{
    /**
     * @var int
     */
    private $questionID;

    /**
     * @var int
     */
    private $hard;

    /**
     * @var string
     */
    private $topic;

    /**
     * @var string
     */
    private $correct;

    /**
     * @var string
     */
    private $wrong1;

    /**
     * @var string
     */
    private $wrong2;

    /**
     * @var string
     */
    private $wrong3;

    /**
     * @var string
     */
    private $question;

    /**
     * @var array
     */
    private $questions = [];

    /**
     * Question constructor.
     */
    public function __construct()
    {
        $this->questionID = null;
        $this->hard = null;
        $this->topic = null;
        $this->correct = null;
        $this->wrong1 = null;
        $this->wrong2 = null;
        $this->wrong3 = null;
        $this->question = null;
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
     * @return string
     */
    public function getCorrect()
    {
        return $this->correct;
    }

    /**
     * @param string $correct
     */
    public function setCorrect($correct)
    {
        $this->correct = $correct;
    }

    /**
     * @return string
     */
    public function getWrong1()
    {
        return $this->wrong1;
    }

    /**
     * @param string $wrong1
     */
    public function setWrong1($wrong1)
    {
        $this->wrong1 = $wrong1;
    }

    /**
     * @return string
     */
    public function getWrong2()
    {
        return $this->wrong2;
    }

    /**
     * @param string $wrong2
     */
    public function setWrong2($wrong2)
    {
        $this->wrong2 = $wrong2;
    }

    /**
     * @return string
     */
    public function getWrong3()
    {
        return $this->wrong3;
    }

    /**
     * @param string $wrong3
     */
    public function setWrong3($wrong3)
    {
        $this->wrong3 = $wrong3;
    }

    /**
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param string $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @param $item
     */
    public function pushToQuestions($item) {
        array_push($this->questions, $item);
    }

    /**
     * @param $questionID
     */
    public function getQuestions($questionID) {
        $sql = 'SELECT * FROM Questions WHERE QUESTIONID = \'' . $questionID. '\'';
        $result = Database::query($sql);

        if ($row = oci_fetch_array($result)) {
            $this->setQuestionID($row[0]);
            $this->setHard($row[1]);
            $this->setTopic($row[2]);
            $this->setCorrect($row[3]);
            $this->setWrong1($row[4]);
            $this->setWrong2($row[5]);
            $this->setWrong3($row[6]);
            $this->setQuestion($row[7]);
        }
    }

    /**
     * Returns a random question with the given parameters
     * @param $topic
     * @param $stack
     * @param $hard
     * @return mixed
     */
    public function getRandomQuestion($topic, $stack, $hard) {
        $questions = [];
        $alreadyLogged = '';

        foreach ($stack as $item) {
            $alreadyLogged .= ' AND QUESTIONID != ' . $item;
        }

        $sql = 'SELECT QUESTIONID FROM Questions WHERE TOPIC = \'' . $topic .
                '\' AND HARD = ' . $hard . $alreadyLogged;

        $result = Database::query($sql);

        while ($row = oci_fetch_array($result)) {
            array_push($questions, $row[0]);
        }

        $question =  $questions[array_rand($questions)];

        return $question;
    }

    /**
     * @return mixed
     */
    public function random() {
        while (true) {
            $arr = [
                $this->getWrong1(),
                $this->getWrong2(),
                $this->getWrong3(),
                $this->getCorrect(),
            ];

            $question = $arr[array_rand($arr)];

            if (!in_array($question, $this->questions)) {
                $this->pushToQuestions($question);
                return $question;
            }
        }
    }
}
