<?php

$conn = oci_connect('system', 'Aladar12', 'localhost:1522/orcl');

if ($conn) {
    echo 'Sikerült!';
}
else {
    echo "Te szar vagy!";
}
