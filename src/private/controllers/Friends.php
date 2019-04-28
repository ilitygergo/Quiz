<?php

class Friends extends Controller {

    private $userID;
    private $friendsList;

    /**
     * Friends constructor.
     * @param $userID
     * @param $friendsList
     */
    public function __construct()
    {
        $this->userID = null;
        $this->friendsList = null;
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
    public function getFriendsList()
    {
        return $this->friendsList;
    }

    /**
     * @param mixed $friendsList
     */
    public function setFriendsList($friendsList)
    {
        $this->friendsList = $friendsList;
    }

    public function loadFriends($userID){
        $this->setUserID($userID);
        $sql = "SELECT * FROM FRIENDS WHERE USER1 = $userID OR USER2 = $userID";
        $result = Database::query($sql);
        $friends = null;

        while ($row = oci_fetch_array($result)) {
            if($row[0] != $userID){
                if( ! empty($friends) ) {
                    if (!array_key_exists($row[1], $friends)) {
                        $friends[$row[0]] = $row[2];
                    }
                } else {
                    $friends[$row[0]] = $row[2];
                }
            } else {
                if (! empty($friends)) {
                    if ((!array_key_exists($row[1], $friends)) AND ($row[1] != $userID)) {
                        $friends[$row[1]] = $row[2];
                    }
                } else {
                    $friends[$row[1]] = $row[2];
                }
            }
        }

        $this->setFriendsList($friends);
    }

    public function printFriends($id){
        require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/models/User.php');
        $this->loadFriends($id);

        foreach ($this->friendsList as $id => $since){
            $user = new User();
            $user->getUser($id);

            echo '<tr>';
            echo '<td>'.$user->getFirstName().'</td>';
            echo '<td>'.$user->getLastName().'</td>';
            echo '<td>'.$since.'</td>';
            echo '<td><button type="button" class="btn btn-warning">Challenge</button>   ';
            echo '<button type="button" class="btn btn-danger">Delete</button></td>';
            echo '</tr>';

        }


    }

}
