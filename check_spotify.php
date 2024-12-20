<?php
session_start();

if (isset($_SESSION['spotify_access_token'])) {
    echo json_encode(["connected" => true]);
} else {
    echo json_encode(["connected" => false]);
}
?>
