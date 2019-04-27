<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/etc/Database.php');

class User {

    /**
     * @var int
     */
    private $userID;

    /**
     * @var string
     */
    private $userName;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var mixed
     */
    private $birthday;

    /**
     * @var string
     */
    private $gender;

    /**
     * @var int
     */
    private $isAdmin;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->userID = null;
        $this->userName = null;
        $this->firstName = null;
        $this->lastName = null;
        $this->email = null;
        $this->password = null;
        $this->birthday = null;
        $this->gender = null;
        $this->isAdmin = 0;
    }

    /**
     * @return int
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param int
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        $str = substr($this->birthday, 9, 10);
        return $str;
    }

    /**
     * @return mixed
     */
    public function getBirthdayFormal() {
        return $this->birthday;
    }

    /**
     * Birthday has to added as YYYY-MM-DD string
     * @param mixed $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = 'TO_DATE(\'' . $birthday . '\',\'YYYY-MM-DD\')';
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return int
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @param int $isAdmin
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }

    function getUser($userID) {
        $sql = 'SELECT * FROM Usr WHERE USERID = \'' . $userID . '\'';
        $result = Database::query($sql);

        if ($row = oci_fetch_array($result)) {
            $this->setUserID($row[0]);
            $this->setUserName($row[1]);
            $this->setFirstName($row[2]);
            $this->setLastName($row[3]);
            $this->setEmail($row[4]);
            $this->setPassword($row[5]);
            $this->setBirthday($row[6]);
            $this->setGender($row[7]);
            $this->isAdmin = $row[8];
        }
    }

    /**
     * @param $email
     * @param $password
     * @return int
     */
    public function getUserIDByValues($email, $password) {
        $userID = null;

        $sql = 'SELECT USERID FROM Usr WHERE email = \'' . $email . '\' AND password = \'' . $password . '\'';
        $result = Database::query($sql);

        if ($row = oci_fetch_array($result)) {
            $userID = $row[0];
        }

        return $userID;
    }

    /**
     * Validation for registration
     * @throws
     * @return bool
     */
    function validateRegistration() {
        try {
            if (!is_string($this->userName)) {
                throw new Exception("Invalid username!");
            }

            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Invalid email!");
            }

            $this->validPassword($this->getPassword());

            $result = Database::query('SELECT userName FROM Usr WHERE userName = \'' . $this->getUserName() . '\'');

            if (oci_fetch_array($result)) {
                throw new Exception("Your username has to be unique!");
            }

            $result = Database::query('SELECT email FROM Usr WHERE email = \'' . $this->getEmail() . '\'');

            if (oci_fetch_array($result)) {
                throw new Exception("Your email has to be unique!");
            }

            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * @param $pass
     * @throws Exception
     * @return bool
     */
    function validPassword($pass){
        try {
            if (strlen($pass) < 8) {
                throw new Exception("Your password must contain at least 8 characters!");
            } elseif (!preg_match("#[0-9]+#",$this->password)) {
                throw new Exception("Your password must contain at least 1 number!");
            } elseif (!preg_match("#[A-Z]+#",$this->password)) {
                throw new Exception("Your password must contain at least 1 capital letter!");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    function login() {
        try {
            $sql = 'SELECT * FROM Usr WHERE email = \'' . $this->email . '\' AND password = \'' . $this->password . '\'';
            $result = Database::query($sql);

            if (!oci_fetch_array($result)) {
                throw new Exception("Your email or password is not correct!");
            }

            return true;
        } catch (Exception $e) {
            echo $e->getMessage(), "\n";
            return false;
        }
    }

    /**
     * Saves the user to the database
     */
    public function saveUser() {
        $userName = $this->getUserName();
        $firstName = $this->getFirstName();
        $lastName = $this->getLastName();
        $Email = $this->getEmail();
        $Password = $this->getPassword();
        $Birthday = $this->getBirthday();
        $Gender = $this->getGender();
        $isAdmin = $this->getIsAdmin();

        $query = 'INSERT INTO Usr values (NULL, \'' . $userName . '\', \'' . $firstName . '\', \'' . $lastName . '\',' .
                '\'' . $Email . '\', \'' . $Password . '\', ' .
            'TO_DATE(\'' . $Birthday . '\', \'YYYY-MM-DD\') ' . ', \'' . $Gender . '\',' . ' ' . $isAdmin . ')';

        Database::query($query);
    }

    /**
     * Updates a field in the database
     * @param $field
     */
    function updateField($field) {
        $set = '';

        if ($field == 'USERNAME' && $this->getUserName() != null) {
            $set .= $field . ' = \'' . $this->getUserName() . '\'';
        }

        if ($field == 'FIRSTNAME' && $this->getFirstName() != null) {
            $set .= $field . ' = \'' . $this->getFirstName() . '\'';
        }

        if ($field == 'LASTNAME' && $this->getLastName() != null) {
            $set .= $field . ' = \'' . $this->getLastName() . '\'';
        }

        if ($field == 'EMAIL' && $this->getEmail() != null) {
            $set .= $field . ' = \'' . $this->getEmail() . '\'';
        }
        if ($field == 'PASSWORD' && $this->getPassword() != null) {
            $set .= $field . ' = \'' . $this->getPassword() . '\'';
        }

        if ($field == 'GENDER' && $this->getGender() != null) {
            $set .= $field . ' = \'' . $this->getGender() . '\'';
        }

        if ($field == 'BIRTHDAY' && $this->getBirthdayFormal() != null) {
            $set .= $field . ' = ' . $this->getBirthdayFormal() . '';
        }

        $sql = 'UPDATE USR SET ' . $set .  ' WHERE USERID = ' . $this->getUserID();
        Database::query($sql);
    }

    /**
     * @param $field
     * @param $value
     * @return bool
     */
    function uniqueValueInField($field, $value) {
        try {
            $sql = 'SELECT USERID FROM Usr WHERE ' . $field . ' = \'' . $value . '\'';
            $result = Database::query($sql);

            if ($row = oci_fetch_array($result)) {
                if($row[0] == $this->getUserID()) {
                    return true;
                } else {
                    throw new Exception("A " . $field . ' érték már foglalt.');
                }
            } else {
                return true;
            }

        } catch (Exception $e) {
            echo $e->getMessage(), "\n";
            return false;
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $str = $this->getUserName() . ' ' . $this->getFirstName() . ' ' . $this->getLastName() . ' ' .
            $this->getEmail() . ' ' . $this->getPassword() . ' ' . $this->getBirthday() . ' ' .
            $this->getGender() . ' ' . $this->getIsAdmin();
    }

    /**
     * Returns a random USERID
     * @param $ID
     * @return mixed
     */
    public function getRandomUser($ID) {
        $users = [];

        $sql = 'SELECT USERID FROM Usr WHERE USERID != ' . $ID . ' AND ISADMIN = ' . 0;
        $result = Database::query($sql);

        while ($row = oci_fetch_array($result)) {
            array_push($users, $row[0]);
        }

        return $users[array_rand($users)];
    }
}
