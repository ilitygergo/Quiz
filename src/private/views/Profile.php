<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/etc/menu.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/models/User.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/etc/gameControl.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/controllers/Ranklist.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/controllers/Profile.php');

$user = new User();
$profile = new Profile();

if (isset($_SESSION["USERID"])) {
    $user->setUserID($_SESSION["USERID"]);
    $user->getUser($user->getUserID());
}

if (isset($_GET['submit'])) {
    if (isset($_GET["username"]) && $user->getUserName() != $_GET["username"]) {
        if ($user->uniqueValueInField('USERNAME', $_GET["username"])) {
            $user->setUserName($_GET["username"]);
            $user->updateField('USERNAME');
        }
    }

    if (isset($_GET["firstname"]) && $user->getFirstName() != $_GET["firstname"]) {
        $user->setFirstName($_GET["firstname"]);
        $user->updateField('FIRSTNAME');
    }

    if (isset($_GET["lastname"]) && $user->getLastName() != $_GET["lastname"]) {
        $user->setLastName($_GET["lastname"]);
        $user->updateField('LASTNAME');
    }

    if (isset($_GET["email"]) && $user->getEmail() != $_GET["email"]) {
        if ($user->uniqueValueInField('EMAIL', $_GET["email"])) {
            $user->setEmail($_GET["email"]);
            $user->updateField('EMAIL');
        }
    }

    if ($user->getGender() != $_GET["gender"]) {
        $user->setGender($_GET["gender"]);
        $user->updateField('GENDER');
    }

    if (isset($_GET["pass1"]) && isset($_GET["pass2"]) && ($_GET["pass1"] == $_GET["pass2"]) && $_GET["pass1"] != null) {
        $user->setPassword($_GET["pass1"]);
        if ($user->validPassword($user->getPassword())) {
            $user->updateField('PASSWORD');
        }
    }

    if (isset($_GET["birthday"]) && $user->getBirthday() != $_GET["birthday"]) {
        $user->setBirthday($_GET["birthday"]);
        $user->updateField('BIRTHDAY');
    }
}

?>

<div class="flip w3-display-middle">
    <div class="card">
        <div class="face front">
            <h1><?=$user->getUserName()?></h1>
            <table align="center">
                <tr>
                    <td>Firstname:</td>
                    <td><?=$user->getFirstName()?></td>
                </tr>

                <tr>
                    <td>Lastname:</td>
                    <td><?=$user->getLastName()?></td>
                </tr>

                <tr>
                    <td>Email:</td>
                    <td><?=$user->getEmail()?></td>
                </tr>

                <tr>
                    <td>Birthday:</td>
                    <td><?=$user->getBirthday()?></td>
                </tr>

                <tr>
                    <td>Gender:</td>
                    <td><?=$user->getGender()?></td>
                </tr>
                <?php if($user->getIsAdmin() == 1 ) : ?>
                    <tr>
                        <td>Place:</td>
                        <td>-</td>
                    </tr>

                    <tr>
                        <td>Points:</td>
                        <td>-</td>
                    </tr>
                <?php else : ?>
                    <tr>
                        <td>Place:</td>
                        <td><?=$profile->getUserPlace($_SESSION['USERID']);?></td>
                    </tr>

                    <tr>
                        <td>Points:</td>
                        <td><?=$profile->getUserPoints($_SESSION['USERID']);?></td>
                    </tr>
                <?php endif; ?>
            </table>
            <button id="btn-my-stat-profile" class="btn btn-warning button-left"  data-toggle="modal" data-target="#Mymodal">My Stat</button>
            <button id="btn-edit-profile" class="btn btn-warning button-right"><i class="fas fa-pencil-alt"> Edit</i></button>
        </div>

        <div class="face back">
            <form>
                <div class="form-row">
                    <div class="col">
                        <label for="inputEmail4">Username</label>
                        <input name="username" type="text" class="form-control" autocomplete="off" value="<?=$user->getUserName()?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input name="email" type="email" class="form-control" id="inputEmail4" value="<?=$user->getEmail()?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <label for="inputEmail4">First name</label>
                        <input name="firstname" type="text" class="form-control" value="<?=$user->getFirstName()?>">
                    </div>
                    <div class="col">
                        <label for="inputEmail4">Last name</label>
                        <input name="lastname" type="text" class="form-control" value="<?=$user->getLastName()?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Password</label>
                        <input name="pass1" type="password" class="form-control" id="inputPassword4" placeholder="Password">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Password</label>
                        <input name="pass2" type="password" class="form-control" id="inputPassword4" placeholder="Password again">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <label for="inputEmail4">Gender</label>
                        <select name="gender" class="form-control" id="profile-form-gender">
                            <option value="male" <?php if ($user->getGender() == 'male') echo 'selected'; ?>>male</option>
                            <option value="female" <?php if ($user->getGender() == 'female') echo 'selected'; ?>>female</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="inputEmail4">Birthday</label>
                        <input id="birthday" name="birthday" type="text" class="form-control" autocomplete="off" value="<?=$user->getBirthday()?>">
                    </div>
                </div>
                <button id="btn-save-profile" class="btn btn-warning" name="submit">Save</button>
                <button id="btn-cancel-profile" class="btn btn-warning" type="button">Back</button>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="Mymodal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Played games by category:
                </h4>
            </div>
            <div class="modal-body">
                <div id="content">
                    <table border="1" style="width:100%">
                        <tr>
                            <td></td>
                            <td><b>Games</b></td>
                            <td><b>All points</b></td>
                            <td>Points</td>
                            <td>Last Played</td>
                            <td>Points(hard)</td>
                            <td>Last Played(hard)</td>
                        </tr>
                        <tr>
                            <td><b>History:</b></td>
                            <td><?=$profile->getNumberOfGames($_SESSION['USERID'], 'history')?></td>
                            <td><?=$profile->countPointsByTopic($_SESSION['USERID'], 'history') +
                                $profile->countPointsByTopicHard($_SESSION['USERID'], 'history')?></td>
                            <td><?=$profile->countPointsByTopic($_SESSION['USERID'], 'history')?></td>
                            <td><?=$profile->lastPlayedDate($_SESSION['USERID'], 'history')?></td>
                            <td><?=$profile->countPointsByTopicHard($_SESSION['USERID'], 'history')?></td>
                            <td><?=$profile->lastPlayedDateHard($_SESSION['USERID'], 'history')?></td>
                        </tr>
                        <tr>
                            <td><b>Geography:</b></td>
                            <td><?=$profile->getNumberOfGames($_SESSION['USERID'], 'geography')?></td>
                            <td><?=$profile->countPointsByTopic($_SESSION['USERID'], 'geography') +
                                $profile->countPointsByTopicHard($_SESSION['USERID'], 'geography')?></td>
                            <td><?=$profile->countPointsByTopic($_SESSION['USERID'], 'geography')?></td>
                            <td><?=$profile->lastPlayedDate($_SESSION['USERID'], 'geography')?></td>
                            <td><?=$profile->countPointsByTopicHard($_SESSION['USERID'], 'geography')?></td>
                            <td><?=$profile->lastPlayedDateHard($_SESSION['USERID'], 'geography')?></td>
                        </tr>
                        <tr>
                            <td><b>Science:</b></td>
                            <td><?=$profile->getNumberOfGames($_SESSION['USERID'], 'science')?></td>
                            <td><?=$profile->countPointsByTopic($_SESSION['USERID'], 'science') +
                                $profile->countPointsByTopicHard($_SESSION['USERID'], 'science')?></td>
                            <td><?=$profile->countPointsByTopic($_SESSION['USERID'], 'science')?></td>
                            <td><?=$profile->lastPlayedDate($_SESSION['USERID'], 'science')?></td>
                            <td><?=$profile->countPointsByTopicHard($_SESSION['USERID'], 'science')?></td>
                            <td><?=$profile->lastPlayedDateHard($_SESSION['USERID'], 'science')?></td>
                        </tr>
                        <tr>
                            <td><b>Technology:</b></td>
                            <td><?=$profile->getNumberOfGames($_SESSION['USERID'], 'technology')?></td>
                            <td><?=$profile->countPointsByTopic($_SESSION['USERID'], 'technology') +
                                $profile->countPointsByTopicHard($_SESSION['USERID'], 'technology')?></td>
                            <td><?=$profile->countPointsByTopic($_SESSION['USERID'], 'technology')?></td>
                            <td><?=$profile->lastPlayedDate($_SESSION['USERID'], 'technology')?></td>
                            <td><?=$profile->countPointsByTopicHard($_SESSION['USERID'], 'technology')?></td>
                            <td><?=$profile->lastPlayedDateHard($_SESSION['USERID'], 'technology')?></td>
                        </tr>
                        <tr>
                            <td><b>Literature:</b></td>
                            <td><?=$profile->getNumberOfGames($_SESSION['USERID'], 'literature')?></td>
                            <td><?=$profile->countPointsByTopic($_SESSION['USERID'], 'literature') +
                                $profile->countPointsByTopicHard($_SESSION['USERID'], 'literature')?></td>
                            <td><?=$profile->countPointsByTopic($_SESSION['USERID'], 'literature')?></td>
                            <td><?=$profile->lastPlayedDate($_SESSION['USERID'], 'literature')?></td>
                            <td><?=$profile->countPointsByTopicHard($_SESSION['USERID'], 'literature')?></td>
                            <td><?=$profile->lastPlayedDateHard($_SESSION['USERID'], 'literature')?></td>
                        </tr>
                    </table>

                    <hr>

                    <h4>Last challenged/challenger:</h4>

                    <table border="1" style="width:100%">
                        <tr>
                            <td></td>
                            <td><b>Date</b></td>
                            <td><b>Username</b></td>
                        </tr>
                        <tr>
                            <td><b>You challenged:</b></td>
                            <td><?=$profile->lastChallenged($_SESSION['USERID'], 0)?></td>
                            <td><?=$profile->lastChallenged($_SESSION['USERID'], 1)?></td>
                        </tr>
                        <tr>
                            <td><b>Challenged you:</b></td>
                            <td><?=$profile->lastChallenger($_SESSION['USERID'], 0)?></td>
                            <td><?=$profile->lastChallenger($_SESSION['USERID'], 1)?></td>
                        </tr>
                    </table>

                    <hr>

                    <h4>Last 3 results:</h4>

                    <table border="1" style="width:100%">
                        <tr>
                            <td><b>Enemy</b></td>
                            <td><b>Score</b></td>
                            <td><b>Hard</b></td>
                            <td><b>Topic</b></td>
                            <td><b>Time</b></td>
                        </tr>
                        <?=$profile->getLastResults($_SESSION['USERID'])?>
                    </table>

                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script>

    $( function() {
        $( "#birthday" ).datepicker({ dateFormat: 'yy-mm-dd' });
    } );

</script>
