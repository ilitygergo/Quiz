<?php

$conn = oci_connect('system', 'Aladar12', 'localhost/orcl');

if ($conn) {
    echo 'Sikerült!';
}
else {
    echo "Te szar vagy!";
}
