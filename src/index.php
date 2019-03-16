<?php

$conn_local = oci_connect('system', 'Aladar12', 'localhost:1522/orcl');
$conn_remote = oci_connect('Admin', '6GfmC3dp-3X_VHc', 'adb.eu-frankfurt-1.oraclecloud.com:1522/dg35fxajz14wteg_quizzdb_medium.atp.oraclecloud.com');

$usr = oci_parse($conn_local, "SELECT * FROM USR");
oci_execute($usr);
$friends = oci_parse($conn_local, "SELECT * FROM FRIENDS");
oci_execute($friends);
$results = oci_parse($conn_local, "SELECT * FROM RESULTS");
oci_execute($results);

?>

<html>
    <head>
    </head>
    <body>
        <h1 align="center">Users</h1>
        <table style="width:50%" border="1" align="center">
            <tr>
                <th>ID</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>Email</th>
                <th>Password</th>
                <th>Birthday</th>
                <th>Gender</th>
                <th>IsAdmin</th>
                <th>Age</th>
            </tr>
            <?php while($row = oci_fetch_array($usr)) { ?>
                <tr>
                    <td><?php echo $row['USERID'] . " "; ?></td>
                    <td><?php echo $row['FIRSTNAME'] . " "; ?></td>
                    <td><?php echo $row['LASTNAME'] . " "; ?></td>
                    <td><?php echo $row['EMAIL'] . " "; ?></td>
                    <td><?php echo $row['PASSWORD'] . " "; ?></td>
                    <td><?php echo $row['BIRTHDAY'] . " "; ?></td>
                    <td><?php echo $row['GENDER'] . " "; ?></td>
                    <td><?php echo $row['ISADMIN'] . " "; ?></td>
                    <td><?php echo $row['AGE'] . " "; ?></td>
                </tr>
            <?php } ?>
        </table>

        <h1 align="center">Friends</h1>
        <table style="width:50%" border="1" align="center">
            <tr>
                <th>User1</th>
                <th>User2</th>
                <th>Since</th>
                <th>Status</th>
            </tr>
            <?php while($row = oci_fetch_array($friends)) { ?>
                <tr>
                    <td><?php echo $row['USER1'] . " "; ?></td>
                    <td><?php echo $row['USER2'] . " "; ?></td>
                    <td><?php echo $row['SINCE'] . " "; ?></td>
                    <td><?php echo $row['STATUS'] . " "; ?></td>
                </tr>
            <?php } ?>
        </table>

        <h1 align="center">Results</h1>
        <table style="width:50%" border="1" align="center">
            <tr>
                <th>ResultID</th>
                <th>Score</th>
                <th>Hard</th>
                <th>Time</th>
                <th>Topic</th>
                <th>UserID</th>
            </tr>
            <?php while($row = oci_fetch_array($results)) { ?>
                <tr>
                    <td><?php echo $row['RESULTSID'] . " "; ?></td>
                    <td><?php echo $row['SCORE'] . " "; ?></td>
                    <td><?php echo $row['HARD'] . " "; ?></td>
                    <td><?php echo $row['TIME'] . " "; ?></td>
                    <td><?php echo $row['TOPIC'] . " "; ?></td>
                    <td><?php echo $row['USERID'] . " "; ?></td>
                </tr>
            <?php } ?>
        </table>
    </body>
</html>
