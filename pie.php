<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" 
  "http://www.w3.org/TR/html4/strict.dtd">
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Моя первая веб-страница</title>
 </head>

<style>
img {
  image-rendering: auto;
  image-rendering: crisp-edges;
  image-rendering: pixelated;
}
</style>
 <body>


<?php

include 'config.php';
include LIBS . '/functions.php';



$pie = new Pie();
$pie->add(260, 0xFFFF00, 'rex');
$pie->add(50, 0x00FF00, 'alfa dfasf ffff fffffffff');
$pie->add(350, 0xF633FF, 'ffds');
$pie->add(99, 0x33CAFF, 'me me');
$pie->add(44, 0xff8080, 'asasas ff fdgdfs gdfg  gdg gdfgdf gdfgdfg ');
$pie->add(199, 0xFF5733, 'asasas ff');
$pie->add(rand(1,200), 0x33CAFF, 'ffds');
$pie->add(rand(1,200), 0xFF5733, 'ffds');
$pie->add(rand(1,200), 0xF633FF, 'ffds');
$pie->add(rand(1,200), 0x00FF00, 'other');

$pie->prepare(600, true, 10);
ob_start();

$pie->draw();
$imagedata = ob_get_contents();

ob_end_clean();

?>

<?php
print sprintf ('<img src="data:image/gif;base64,%s">', base64_encode($imagedata));

?>


 </body>
</html>

<?php
exit ();

$size = 500;
$image = ImageCreateTrueColor($size * 2.5, 
    $size  +100);
$background_color = 0xFFFFFF; // Белый

//закарска
/*
ImageFilledRectangle($image, 0, 0,
    $size *2, 
    $size *2, 
    $background_color);
    $black = 0x510f00; // То есть 0
*/
$cy = $cx = $size / 2;
$cx += 100;
$width = $height = $size - 1;

createPie($image, $cx, $cy, $width , $height , 0 , 100 ,  0xFFFF00);
createPie($image, $cx , $cy, $width , $height , 100 , 200 ,  0x00FF00);
createPie($image, $cx , $cy, $width , $height , 200 , 250 ,  0xF633FF);
createPie($image, $cx, $cy, $width , $height , 250 , 300 ,  0x33CAFF);
createPie($image, $cx, $cy, $width , $height , 300 , 360 ,  0xFF5733 );


imagefilledellipse ( $image , $cx, $cy, $width/2 , $height/2, $background_color );

/*print info*/
$x = $cx + $width/2.5;
$y = $cy;
$arr = turn($cx, $cy, $x, $y, 50);
$x = $arr[0];
$y = $arr[1];
$black = 0x510f00;

ImageFTText($image, 10, 0, $x, $y, $black, './fonts/OpenSans-Regular.ttf',
    'xx%');

$arr = turn($cx, $cy, $x, $y, 100);
$x = $arr[0];
$y = $arr[1];

ImageString($image, 
    1, //font
    $x , //x
    $y, //y
    "xx%", //print string
    $black);

$arr = turn($cx, $cy, $x, $y, 75);
$x = $arr[0];
$y = $arr[1];

ImageString($image, 
    1, //font
    $x , //x
    $y, //y
    "xx%", //print string
    $black);


$arr = turn($cx, $cy, $x, $y, 50);
$x = $arr[0];
$y = $arr[1];

ImageString($image, 
    1, //font
    $x , //x
    $y, //y
    "xx%", //print string
    $black);

$arr = turn($cx, $cy, $x, $y, 55);
$x = $arr[0];
$y = $arr[1];

ImageString($image, 
    1, //font
    $x , //x
    $y, //y
    "xx%", //print string
    $black);


//$line = new Line($cx, $cy  ,$cx + $width, $cy);
//$line->turn(100);
//$line->drawLine($image);

// ресэмплирование
/*
$new_width = ($size * 2.5)/4;
$new_height = ($size+100)/4;
 $image_p = imagecreatetruecolor($new_width, $new_height);
 
imagecopyresampled($image_p, $image, 0, 0, 0, 0, 
    $new_width, $new_height, 
     $size * 2.5, $size  +100);
ImageDestroy($image);
*/
header('Content-type: image/png');

ImagePNG($image);
ImageDestroy($image);

