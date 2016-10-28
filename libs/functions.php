<?php

function __autoload($class )
{
    include_once(LIBS.'/'.$class.'.php' );
}


function createPie($image, $cx, $cy, $width , $height , $start , $end , $color )
{

    return  imagefilledarc ( $image, 
        $cx , 
        $cy , 
        $width , 
        $height , 
        $start , 
        $end , 
        $color , 
        IMG_ARC_PIE );
}


function turn($x1, $y1, $x2, $y2, $angle = 45)
{


    $pi = 3.14;

    $_x = $x1+($x2 - $x1) * cos($angle * $pi/180)
        -($y2 -$y1) * sin($angle* $pi/180); 


    $_y = $y1 + ($x2 - $x1)*sin($angle* $pi/180)
        + ($y2 -  $y1)  *cos($angle* $pi/180);

    return array($_x, $_y);
}

