<?php

class File {
    
    public static function build_path($path_array) {
        $ds = DIRECTORY_SEPARATOR;
        $ROOT_FOLDER = __DIR__ . "$ds..";
        return $ROOT_FOLDER . "$ds" . join("$ds", $path_array);
    }

}
