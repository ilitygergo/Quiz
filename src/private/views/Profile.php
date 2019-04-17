<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/etc/menu.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/models/User.php');

$user = new User();

if (isset($_SESSION["USERID"])) {
    $user->setUserID($_SESSION["USERID"]);
    $user->getUser($user->getUserID());
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

                <tr>
                    <td>Place:</td>
                    <td>1001231.</td>
                </tr>

                <tr>
                    <td>Score:</td>
                    <td>554564</td>
                </tr>
            </table>
            <button id="btn-my-stat-profile" class="btn btn-info button-left">My Stat</button>
            <button id="btn-edit-profile" class="btn btn-info button-right"><i class="fas fa-pencil-alt"> Edit</i></button>
        </div>
        <div class="face back">
            <form>
                <div class="form-row">
                    <div class="col">
                        <label for="inputEmail4">First name</label>
                        <input type="text" class="form-control" placeholder="">
                    </div>
                    <div class="col">
                        <label for="inputEmail4">Last name</label>
                        <input type="text" class="form-control" placeholder="">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Password</label>
                        <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <label for="inputEmail4">Gender</label>
                        <select class="form-control" id="profile-form-gender">
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="inputEmail4">Birthday</label>
                        <input type="text" class="form-control" placeholder="">
                    </div>
                </div>
            </form>
            <button id="btn-save-profile" class="btn btn-info">Save</button>
            <button id="btn-cancel-profile" class="btn btn-info">Cancel</button>
        </div>
    </div>
</div>
