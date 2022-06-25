<?php

$conn = mysqli_connect("localhost", "root", "", "form");

if (!$conn) {
    echo "Connection Failed";
}