<?php

class Pie
{   

    protected $arrayValue;
    protected $sumValue;


    public function __construct()
    {

    } 

    public function add($val, $color, $info)
    {
        $this->sumValue += $val;
        $this->arrayValue[] = array(
            'value' => $val, 
            'color' => $color,
            'info' => $info
        );
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

    public function draw($radius, $printInfo = true, $fontSize = 10)
    {
        $size = $radius + 1;
        $image = ImageCreateTrueColor($size * 2.5, 
            $size  + 100);

        $y = $x = $radius / 2 + 20;

        $end = 0;
        $xline = $x+($radius/2.5);
        $yline = $y;
        $old_r = 0;

        $info_x = $radius * 1.2;
        $info_y = $radius / 10;

        for ($i=0; $i<count($this->arrayValue);$i++)
        {
            $start = $end;
            $color = $this->arrayValue[$i]['color'];
            $percent = $this->arrayValue[$i]['value']/$this->sumValue;
            $end = $start + ($percent * 360);
            $info = $this->arrayValue[$i]['info'];

            //print $end . "\n";

            $this->createPie($image, $x, $y, $radius,  $radius, 
                $start , 
                ceil($end),  
                $color);


            /*print information */

            imagefilledellipse($image, $info_x , $info_y + $fontSize/2,  $fontSize*2, $fontSize*2, $color);

            ImageFTText($image, $fontSize , 0, $info_x + $fontSize*2, $info_y + $fontSize, 0x00FF00, 
                './fonts/OpenSans-Regular.ttf',
                $info );
            $info_y += $fontSize * 4;


            /*print info in pie
             *
             * need half old and half new
             * */
            
            $r = ($end - $start)/2 +  $old_r;

            $old_r = ($end - $start)/2;


            $arr = $this->turn($x, $y, $xline, $yline, $r);
            $xline = $arr[0];
            $yline = $arr[1];

            if(floor($percent*100) < 4 ) 
            {
                continue;
            }

            ImageFTText($image, $fontSize, 0, $xline, $yline, 0x000000, 
                './fonts/OpenSans-Regular.ttf',
                round($percent * 100 , 1) . '%');

        }

        ImageFilledEllipse($image, $x , $y,  $radius/2, $radius/2, 0xffffff);

        $new_width = ($size * 2.5)/4;
        $new_height = ($size+100)/4;
        $image_p = imagecreatetruecolor($new_width, $new_height);

        imagecopyresampled($image_p, $image, 0, 0, 0, 0, 
            $new_width, $new_height, 
            $size * 2.5, $size  +100);
        ImageDestroy($image);


        header('Content-type: image/GIF');

        ImageGIF($image_p);
        ImageDestroy($image_p);

    }


}
