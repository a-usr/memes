[
<?php // I scapped this haha
    $memes = array();
    $path = "../assets/memes";
    if ($handle = opendir($path)) {
        $first = true;
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != ".." && is_file($path . '/' . $entry)) {
                if (!$first){
                    echo ",";
                }
                echo ' 
    "' . $path . "/" . $entry . '"';
                $first = false;
            }
        }
        closedir($handle);
    }
?>
]
