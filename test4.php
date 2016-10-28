<?php

$styles = [IMG_ARC_PIE,
IMG_ARC_CHORD,

IMG_ARC_PIE | IMG_ARC_NOFILL,
IMG_ARC_PIE | IMG_ARC_NOFILL | IMG_ARC_EDGED,

IMG_ARC_NOFILL | IMG_ARC_EDGED];


$size = 100;
$image = ImageCreateTrueColor($size * count($styles), $size);
$background_color = 0xFFFFFF; // Белый
ImageFilledRectangle($image, 0, 0,
    $size * count($styles) - 1, $size * count($styles) - 1, $background_color);
$black = 0x510f00; // То есть 0
for ($i = 0; $i < count($styles); $i++) 
{
    ImageFilledArc($image, 
        $size / 2 + $i * $size, 
        $size / 2,
        $size - 1, $size - 1, 0, 135, $black, $styles[$i]);
}
header('Content-type: image/png');
ImagePNG($image);
ImageDestroy($image);
