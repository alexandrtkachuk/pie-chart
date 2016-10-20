

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Моя первая веб-страница</title>
        <link rel="stylesheet" href="style.css">


    </head>
    <body>
        <!-- style="position: relative; width: 200px;height: 200px;" -->
        <div id="container" >


<?php
$cover = "position: absolute;
    width: 100%;
    height: 100%;
    clip: rect(0 200px 200px 100px);";

$pie = "position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    clip: rect(0 100px 200px 0px);";

$arr = array(
    array('color' => 'red', 'percent' => 20, 'name' =>'test' ),
    array('color' => 'green', 'percent' => 15, 'name' =>'test2' ),
    array('color' => 'yellow', 'percent' => 35, 'name' =>'test3' ),
    array('color' => 'Black', 'percent' => 5, 'name' =>'test4' ),
    array('color' => '#CD5C5C', 'percent' => 10, 'name' =>'test3' ),
    array('color' => '#FF1493', 'percent' => 6, 'name' =>'test3'),
    array('color' => '#00CD00', 'percent' => 9, 'name' =>'test3'),
);

    $transform = 0;

    for ($i = 0; $i < count($arr); $i++)
    {
        $p =     $arr[$i]['percent'];
        $mass = 360 * ($arr[$i]['percent']/100);
        #print "$mass";
        $color = $arr[$i]['color'];

        //echo '<div  class="cover"  style="' . "transform: rotate($transform" ."deg); $cover \"> ";
        //echo '<div  class="pie" style="'. "background-color: $color; transform: rotate($mass" . "deg); $pie \" info=\"$p\"  ></div>";  
        //echo '</div>';
        

        echo '<div  class="cover"  style="' . "transform: rotate($transform" ."deg);\"> ";
        echo '<div  class="pie" style="'. "background-color: $color; transform: rotate($mass" . "deg); \" info=\"$p\"  ></div>";  
        echo '</div>';
        
         $transform += $mass;
    }

 

?>
<!--div id="part2-wrapper" class="cover">
<div id="part2" class="pie"></div>
</div-->

        </div>        



    </body>
</html>
