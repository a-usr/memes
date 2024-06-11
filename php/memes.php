[
<?php
    $memes = array();
    $path = "../assets/memes";
    if ($handle = opendir($path)) {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != ".." && is_file($path . '/' . $entry)) {
                echo '  "' . $path . "/" . $entry . '",
';
            }
        }
        closedir($handle);
    }
?>
]
