<?php

class Users extends Controller
{
    private $usersList;

    /**
     * Users constructor.
     * @param $usersList
     */
    public function __construct()
    {
        $this->usersList = null;
    }

    /**
     * @return mixed
     */
    public function getUsersList()
    {
        return $this->usersList;
    }

    /**
     * @param mixed $usersList
     */
    public function setUsersList($usersList)
    {
        $this->usersList = $usersList;
    }

    public function loadUsersList(){
        $sql = "SELECT userid,username
                FROM Usr
                WHERE isadmin = 0
                ORDER BY USERNAME ASC";
        $result = Database::query($sql);
        $array = null;
        while($row = oci_fetch_array($result,OCI_NUM)){
            $array[$row[0]] = $row[1];
        }
        self::setUsersList($array);
    }

    public function printUsersTable(){
        self::loadUsersList();
        echo '<table class="w3-table w3-border w3-bordered w3-centered w3-hoverable">';
        echo '<tr>';
        echo '<th>USERNAME</th>';
        echo '<th>USERID</th>';
        echo '</tr>';

        foreach ($this->usersList as $id => $username){
            echo '<tr>';
            echo '<td><a href="Users?userid='.$id.'">'.$username.'</a></td>';
            echo '<td>'.$id.'</td>';
            echo '</tr>';
        }
    }

    public function printSpecificUserProfile($userId){
        $user = new User();
        $user->getUser($userId);?>
        <h5><b><i class="fa fa-user-circle "></i> USER INFORMATION </b></h5>
        <div class="w3-blue w3-round-xlarge w3-card">
            <div class="w3-blue w3-round-xlarge">
                <div style="margin-top:2em;">
                    <table class="w3-table w3-hoverable">
                        <tr>
                            <td><i class="fa fa-user w3-large"></i></td>
                            <td><b>NAME</b></td>
                            <td><?= $user->getFirstName().' '.$user->getLastName(); ?></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-envelope w3-large "></i></td>
                            <td><b>E-MAIL</b></td>
                            <td><?= $user->getEmail() ?></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-calendar w3-large "></i></td>
                            <td><b>BIRTHDAY</b></td>
                            <td><?= $user->getBirthday() ?></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-venus-mars w3-large "></i></td>
                            <td><b>GENDER</b></td>
                            <td><?= $user->getGender() ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <button class="w3-button w3-margin-top w3-blue-gray w3-wide w3-display-left" onclick="location.href=`Users`;">
            GO BACK
        </button>
        <?php if(!self::areFriends($_SESSION['USERID'],$userId)): ?>
        <button class="w3-button w3-margin-top w3-green w3-wide w3-display-right"
                onclick="location.href=`addFriend?user1=<?=$_SESSION['USERID']?>&user2=<?=$userId?>`;">
            ADD FRIEND
        </button>
        <?php endif; ?>
<?php
    }

    public function validUserId($userid)
    {
        if (is_numeric($userid)) { //escape SQL injection
            $sql = "
            SELECT USERID,USERNAME
            FROM USR
            ";
            $result = Database::query($sql);
            $array = null;
            while ($row = oci_fetch_array($result,OCI_NUM)) {
                $array[$row[0]] = $row[1];
            }
            if (array_key_exists($userid, $array)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function areFriends($user1,$user2){
        $sql = "SELECT * 
                FROM FRIENDS 
                WHERE (USER1 = $user1 AND USER2 = $user2) OR (USER1 = $user2 AND USER2 = $user1)";
        $result = Database::query($sql);
        while($row = oci_fetch_array($result,OCI_NUM)){
            if($row[0] == $user1 OR $row[1] == $user1){
                return true;
            }
        }
        return false;
    }

    public function addFriend($user1,$user2){
        if(!self::areFriends($user1,$user2)) {
            $sql = "INSERT INTO FRIENDS (USER1, USER2, SINCE, STATUS) 
                    VALUES ('$user1', '$user2', 
                    TO_DATE('".date('Y-m-d')."', 'YYYY-MM-DD'), 'active')";
            Database::query($sql);
        }
    }
}