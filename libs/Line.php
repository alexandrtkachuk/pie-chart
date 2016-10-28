<?php

class Line
{
    protected $A;
    protected $B;
    protected $C;
    protected $x1;
    protected $y1;
    protected $x2;
    protected $y2;

    public function __construct($x1, $y1, $x2, $y2)
    {
        $this->B = $x1 -  $x2;
        $this->A = $y1- $y2; // = 0
        $this->C = ($this->A *$x1 + $this->B *$y1) * -1;

        
        $this->x1 = $x1;
        $this->y1 = $y1;

        $this->x2 = $x2;
        $this->y2 = $y2;


    }
    

    public function update()
    {
        $this->B = $this->x1 -  $this->x2;
        $this->A = $this->y1- $this->y2; // = 0
        $this->C = ($this->A *$this->x1 + $this->B *$this->y1) * -1;
    } 
    
    public function isExist($x, $y)
    {
        if ( $this->A*$x+$this->B*$y+$this->C == 0)
        {
            return true;
        }

        return false;
    }

    public function setNewPoints($x1, $y1, $x2, $y2)
    {
        if(!$this->isExist($x1, $y1) || !$this->isExist($x2, $y2))
        {
            return false;
        }

        $this->x1 = $x1;
        $this->y1 = $y1;

        $this->x2 = $x2;
        $this->y2 = $y2;

        return true;
    }

    public function turn($angle = 100)
    {

                
        $pi = 3.14;

        $_x = $this->x1+($this->x2 - $this->x1) * cos($angle * $pi/180)
             -($this->y2 -$this->y1) * sin($angle* $pi/180); 


        $_y = $this->y1 + ($this->x2 - $this->x1)*sin($angle* $pi/180)
            + ($this->y2 -  $this->y1)  *cos($angle* $pi/180);


        $this->x2 = $_x  ;
        $this->y2 = $_y ;

    }

    public function drawLine($image, $color =0 )
    {

        imageline($image, 
            $this->x1, //statrt x
            $this->y1, //start y 
            $this->x2, //end x
            $this->y2,  //end y
            $color /*color*/);


        ImageString($image, 
            1, //font
            $this->x1, //x
            $this->y1, //y
            "x2:" . $this->x2 . "           y2:" . $this->y2, //print string
            0);

    }

    public function getY($x = 0)
    {
        if($this->B == 0) return false;

        $y = ($this->A*$x+$this->C)/$this->B;

        return -1*$y;
    }

    
}

