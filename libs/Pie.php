<?php

class Pie
{   

    protected $arrayValue;
    protected $sumValue;
    protected $image;

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

        return  imagefilledarc ( $this->image, 
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
    
    public function prepare($radius, $printInfo = true, $fontSize = 10)
    {
        $size = $radius + 1;
        $this->image = ImageCreateTrueColor($size * 2.5, 
            $size  + 100);

        ImageFilledRectangle($this->image, 0, 0,
            $size *2.5, 
            $size +100, 
            0xffffff);

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
            $end = floor($start + ($percent * 360));
            $info = $this->arrayValue[$i]['info'];
            if($start == $end)
            {
                $end++;
            }

            if ($i == count($this->arrayValue) - 1)
            {
                $end = 360;
            }
            

            print "$i)start: $start  end: $end \n<br/>";

            //print $end . "\n";

            $this->createPie($this->image, $x, $y, $radius,  $radius, 
                $start , 
                $end,  
                $color);

            
            /*print information */

            imagefilledellipse($this->image, $info_x , $info_y + $fontSize/2,  $fontSize*2, $fontSize*2, $color);

            ImageFTText($this->image, $fontSize , 0, $info_x + $fontSize*2, $info_y + $fontSize, 0x00FF00, 
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

            ImageFTText($this->image, $fontSize, 0, $xline, $yline, 0x000000, 
                './fonts/OpenSans-Regular.ttf',
                round($percent * 100 , 1) . '%');

        }

        ImageFilledEllipse($this->image, $x , $y,  $radius/2, $radius/2, 0xffffff);


    }

    public function draw()
    {
                

        //header('Content-type: image/GIF');

        ImageGIF($this->image);
        ImageDestroy($this->image);

    }


}
