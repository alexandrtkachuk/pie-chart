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
