<?php

$width = 200;
$height = 50;
$image = ImageCreateTrueColor($width, $height);
$background_color = 0xFFFFFF; // Белый
ImageFilledRectangle($image, 0, 0, $width - 1, $height - 1, $background_color);
$x1 = $y1 = 0 ; // 0
$x2 = $y2 = $height - 1; // 49
$color = 0xCCCCCC; // Серый
ImageLine($image, $x1, $y1, $x2, $y2, $color);
header('Content-type: image/png');
ImagePNG($image);
ImageDestroy($image);
