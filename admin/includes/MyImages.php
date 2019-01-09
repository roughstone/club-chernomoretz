<?php
class MyImages {

    public function resizeAnImage($filePath, $fileSize){
        $save = $filePath; // new file 
        $file = $filePath; // original file
        list($width, $height) = getimagesize($file) ;
            if ($width > $fileSize){
        $modwidth = $fileSize;
        } else {
        $modwidth = $width;
        }
        $diff = $width / $modwidth;
        $modheight = $height / $diff;   
        $tn = imagecreatetruecolor($modwidth, $modheight) ;
        $image = imagecreatefromjpeg($file) ;
        imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;                   
        imagejpeg($tn, $save, 100) ;
    }

}