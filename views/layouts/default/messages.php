<?php
if(isset($_SESSION['messages'])){
//    echo "<ul class='messagesList'>";
//    foreach ($_SESSION['messages'] as $message) {
//        echo "<li class='". $message['type'] . "'>";
//        echo htmlspecialchars($message['text']);
//        echo "</li>";
//    }
//    echo "</ul>";
    foreach ($_SESSION['messages'] as $message) {
        echo '<div class="alert alert-dismissible alert-success">' .
                '<button type="button" class="close" data-dismiss="alert">×</button>';
                echo htmlspecialchars($message['text']);
       echo '</div>';
    }
    unset($_SESSION['messages']);
}