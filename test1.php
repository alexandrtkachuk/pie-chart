<?php

$image = ImageCreateTrueColor(200, 50); // По умолчанию черный

// Выбрать серый цвет фона
 $grey = 0xCCCCCC;
 ImageFilledRectangle($image, 0, 0, 200 - 1, 50 - 1, $grey);
 // Нарисовать белый прямоугольник
 $white = 0xFFFFFF;
 ImageFilledRectangle($image, 50, 10, 150, 40, $white);
 header('Content-type: image/png');
 ImagePNG($image);
 ImageDestroy($image);
