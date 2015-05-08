<?php
foreach ($this->categories as $category) :
    echo '<option>' . htmlspecialchars($category['text']) . '</option>';
endforeach;