<?php
if(isset($_SESSION['messages'])){
    foreach ($_SESSION['messages'] as $message) {
        echo '<div class="'. $message['class'] .'"">' .
                '<button type="button" class="close" data-dismiss="alert">×</button>';
                echo htmlspecialchars($message['text']);
       echo '</div>';
    }
    unset($_SESSION['messages']);
}