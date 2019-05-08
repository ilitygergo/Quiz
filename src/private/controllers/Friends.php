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

    /**
     * @param $id
     */
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

            echo '<td><button type="button"  data-toggle="modal" data-target="#profile-modal" 
                    onclick="Challenge(' . $user->getUserID() . ', \'' . $user->getUserName() . '\')" class="btn btn-warning">Challenge</button></td>';

            echo '<td><form method="post">';
            echo '<button type="submit" value="' . $user->getUserID() . '" class="btn btn-danger">Delete</button>';
            echo '<input type="hidden" name="delete" value="' . $user->getUserID() . '">';
            echo '</form></td>'    ;

            echo '</tr>';

        }
    }

    /**
     * @param $friendID
     * @param $userID
     * @return bool
     */
    public function deleteFriend($friendID, $userID) {
        $sql = 'DELETE FROM Friends WHERE (USER1 = ' . $friendID . ' AND USER2 = ' . $userID .
        ') OR (USER2 = ' . $friendID . ' AND USER1 = ' . $userID . ')';
        $result = Database::query($sql);

        if ($result) {
            return true;
        }

        return false;
    }

}
