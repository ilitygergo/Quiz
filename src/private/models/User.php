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
        return $this->birthday;
    }

    /**
     * Birthday has to added as YYYY-MM-DD string
     * @param mixed $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
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
            $this->userID = $row[0];
            $this->userName = $row[1];
            $this->firstName = $row[2];
            $this->lastName = $row[3];
            $this->email = $row[4];
            $this->password = $row[5];
            $this->birthday = $row[6];
            $this->gender = $row[7];
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
    function validate() {
        try {
            if (!is_string($this->userName)) {
                throw new Exception("Invalid username!");
            }

            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Invalid email!");
            }

            if (strlen($this->password) < 8) {
                throw new Exception("Your password must contain at least 8 characters!");
            } elseif (!preg_match("#[0-9]+#",$this->password)) {
                throw new Exception("Your password must contain at least 1 number!");
            } elseif (!preg_match("#[A-Z]+#",$this->password)) {
                throw new Exception("Your password must contain at least 1 capital letter!");
            }

            $result = Database::query('SELECT userName FROM Usr WHERE userName = \'' . $this->userName . '\'');

            if (oci_fetch_array($result)) {
                throw new Exception("Your username has to be unique!");
            }

            $result = Database::query('SELECT email FROM Usr WHERE email = \'' . $this->email . '\'');

            if (oci_fetch_array($result)) {
                throw new Exception("Your email has to be unique!");
            }

            return true;
        } catch (Exception $e) {
            echo $e->getMessage(), "\n";
            return false;
        }
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
            'TO_TIMESTAMP(\'' . $Birthday . '\', \'YYYY-MM-DD\') ' . ', \'' . $Gender . '\',' . ' ' . $isAdmin . ')';

        Database::query($query);
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
}
