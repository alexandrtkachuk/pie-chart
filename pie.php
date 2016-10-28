<?php

include 'config.php';
include LIBS . '/functions.php';





function getLineParams()
{


}

$styles = [IMG_ARC_PIE,
IMG_ARC_CHORD,

IMG_ARC_PIE | IMG_ARC_NOFILL,
IMG_ARC_PIE | IMG_ARC_NOFILL | IMG_ARC_EDGED,

IMG_ARC_NOFILL | IMG_ARC_EDGED];


$size = 500;
$image = ImageCreateTrueColor($size * 3, 
    $size  + 500);
$background_color = 0xFFFFFF; // Белый
ImageFilledRectangle($image, 0, 0,
    $size * count($styles) - 1, $size * count($styles) - 1, $background_color);
$black = 0x510f00; // То есть 0

$cy = $cx = $size / 2;
$cx += 100;
$width = $height = $size - 1;

createPie($image, $cx, $cy, $width , $height , 0 , 100 ,  0xFFFF00);
createPie($image, $cx , $cy, $width , $height , 100 , 200 ,  0x00FF00);

/*
 * Ax + By + C = 0
 * X = x1+(x2-x1)*cos(A)-(y2-y1)*sin(A)
 * Y = y1+(x2-x1)*sin(A)+(y2-y1)*cos(A)
 * */
//
$angle = 100;

$_x = $cx+($cx+500-$cx)*cos($angle)-($cy-$cy)*sin($angle); 
$_y =  -1*$cy+($cx+500-$cx)*sin($angle)+($cy-$cy)*cos($angle);

$line = new Line($cx, $cy  ,$cx + $width, $cy);
$line->turn(100);
$line->drawLine($image);
/*
//$line->isExist(300,210);
$line->setNewPoints($cx,$cy, 
    300, 600);
$line->turn(90);
8$line->drawLine($image, 0x808080);
*/
//get vector StartLine

$B = ($cx -  $cx + 500);
$A = ( $cy - $cy ); // = 0

$C = ($A *$cx + $B *$cy) * -1;

$RES = $A * ($cx + $width/2 - 10) + $B * $cy +  $C;



$info = "A= $A B= $B C= $C   RES:$RES y: $_y x:$_x";



ImageString($image, 
    1, //font
    $cx + $width/2 - 10 , //x
    $cy, //y
    $info, //print string
    $black);

header('Content-type: image/png');

ob_start();

ImagePNG($image);
$imagedata = ob_get_contents();

ob_end_clean();

ImageDestroy($image);


//echo '<img src="data:image/gif;base64,' . base64_encode($imagedata)
//    . '"   width="750" height="250" alt="внедренная иконка папки"/>';

//header("Content-type: " . image_type_to_mime_type(IMAGETYPE_PNG));
echo $imagedata;
