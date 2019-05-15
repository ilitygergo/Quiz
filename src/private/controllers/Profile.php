<?php

class Profile extends Controller {

    /**
     * @param $ID
     * @return int
     */
    public function getUserPoints($ID) {
        $sql = 'SELECT SUM(score) FROM RESULTS WHERE USERID = ' . $ID;
        $result = Database::query($sql);

        if ($row = oci_fetch_array($result,OCI_NUM)){
            return $row[0];
        }

        return 0;
    }

    /**
     * @param $ID
     * @return int
     */
    public function getUserPlace($ID) {
        $place = 1;

        $sql = 'SELECT USERID ,SUM(score) FROM RESULTS GROUP BY USERID ORDER BY SUM(score) DESC';
        $result = Database::query($sql);

        while ($row = oci_fetch_array($result)){
            if ($row[0] === $ID) {
                return $place;
            }
            $place++;
        }

        return $place;
    }

    /**
     * @param $ID
     * @param $topic
     * @return int
     */
    public function getNumberOfGames($ID, $topic) {
        $sql = 'SELECT COUNT(*) FROM RESULTS WHERE USERID = ' . $ID . ' AND TOPIC = \'' . $topic . '\'';
        $result = Database::query($sql);

        if ($row = oci_fetch_array($result,OCI_NUM)){
            return $row[0];
        }

        return 0;
    }

    /**
     * @param $ID
     * @param $topic
     * @return int
     */
    public function countPointsByTopic($ID, $topic) {
        $sql = 'SELECT SUM(score) FROM RESULTS WHERE USERID = ' . $ID . ' AND TOPIC = \'' . $topic . '\' AND HARD = 0';
        $result = Database::query($sql);

        if ($row = oci_fetch_array($result,OCI_NUM)){
            return $row[0];
        }

        return 0;
    }

    /**
     * @param $ID
     * @param $topic
     * @return int
     */
    public function countPointsByTopicHard($ID, $topic) {
        $sql = 'SELECT SUM(score) FROM RESULTS WHERE USERID = ' . $ID . ' AND TOPIC = \'' . $topic . '\'  AND HARD = 1';
        $result = Database::query($sql);

        if ($row = oci_fetch_array($result,OCI_NUM)){
            return $row[0];
        }

        return 0;
    }

    /**
     * @param $ID
     * @param $topic
     * @return int|string
     */
    public function lastPlayedDate($ID, $topic) {
        $sql = 'SELECT MAX(TO_DATE(CHALLENGES.time, \'YYYY-MM-DD\')) FROM CHALLENGES ' .
            'INNER JOIN HAS ON CHALLENGES.challengeid = HAS.challengeid ' .
            'WHERE (CHALLENGES.CHALLENGER = ' . $ID . ' OR CHALLENGES.CHALLENGED = ' . $ID . ') ' .
            'AND CHALLENGES.topic = \'' . $topic . '\' ' .
            'AND (SELECT hard FROM QUESTIONS WHERE questionid = HAS.questionid) = 0';
        $result = Database::query($sql);

        if ($row = oci_fetch_array($result,OCI_NUM)){
            return $row[0];
        }

        return '-';
    }

    /**
     * @param $ID
     * @param $topic
     * @return int|string
     */
    public function lastPlayedDateHard($ID, $topic) {
        $sql = 'SELECT MAX(TO_DATE(CHALLENGES.time, \'YYYY-MM-DD\')) FROM CHALLENGES ' .
            'INNER JOIN HAS ON CHALLENGES.challengeid = HAS.challengeid ' .
            'WHERE (CHALLENGES.CHALLENGER = ' . $ID . ' OR CHALLENGES.CHALLENGED = ' . $ID . ') ' .
            'AND CHALLENGES.topic = \'' . $topic . '\' ' .
            'AND (SELECT hard FROM QUESTIONS WHERE questionid = HAS.questionid) = 1';
        $result = Database::query($sql);

        if ($row = oci_fetch_array($result,OCI_NUM)){
            return $row[0];
        }

        return '-';
    }

    /**
     * @param $ID
     * @param $type
     * @return mixed|string
     */
    public function lastChallenged($ID, $type) {
        $data = [];
        $data[0] = 0;

        $sql = 'SELECT time, USR.username FROM CHALLENGES ' .
            'INNER JOIN USR ON CHALLENGES.challenged = USR.userid ' .
            'WHERE challenger = ' . $ID . ' ' .
            'AND time = (SELECT MAX(time) FROM CHALLENGES WHERE challenger = ' . $ID . ') ';
        $result = Database::query($sql);

        if ($row = oci_fetch_array($result,OCI_NUM)){
            if ($type == 0) {
                return $row[0];
            } else {
                return $row[1];
            }
        }

        return '-';
    }

    /**
     * @param $ID
     * @param $type
     * @return mixed|string
     */
    public function lastChallenger($ID, $type) {
        $data = [];
        $data[0] = 0;

        $sql = 'SELECT time, USR.username FROM CHALLENGES ' .
                'INNER JOIN USR ON CHALLENGES.challenger = USR.userid ' .
                'WHERE challenged = ' . $ID . ' ' .
                'AND time = (SELECT MAX(time) FROM CHALLENGES WHERE challenged = ' . $ID . ') ';
        $result = Database::query($sql);

        if ($row = oci_fetch_array($result,OCI_NUM)){
            if ($type == 0) {
                return $row[0];
            } else if ($type == 1) {
                return $row[1];
            }
        }

        return '-';
    }



}
