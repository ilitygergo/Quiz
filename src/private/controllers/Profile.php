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

    public function countPointsByTopic($ID, $topic) {
        $sql = 'SELECT SUM(score) FROM RESULTS WHERE USERID = ' . $ID . ' AND TOPIC = \'' . $topic . '\'';
        $result = Database::query($sql);

        if ($row = oci_fetch_array($result,OCI_NUM)){
            return $row[0];
        }

        return 0;
    }

}
