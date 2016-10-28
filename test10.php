<?php

function imageEllipseWithBorder($image, $centerX, $centerY, $width, $height, $color, $borderWidth)
    {
        // Calculate inner and outer strength of border
        $borderOuterStrength = (($borderWidth - 1) / 2);
        $borderInnerStrength = ((($borderWidth - 1) / 2) + 1);

        // Caculate x-/y-offset from 0/0 position to ellipse center
        $ellipseXOffset = $centerX - ($width / 2) - $borderOuterStrength;
        $ellipseYOffset = $centerY - ($height / 2) - $borderOuterStrength;

        // Create temp image for editing
        $tempImageWidth  = $width + ($borderOuterStrength * 2) + 1;
        $tempImageHeight = $height + ($borderInnerStrength * 2) + 1;
        $tempImage = imagecreatetruecolor($tempImageWidth, $tempImageHeight);
        imagealphablending($tempImage, false);

        // Fill temp image with "transparent" color
        $transparent = imagecolorallocatealpha($tempImage, 255, 255, 255, 127);
        imagefill($tempImage, 0, 0, $transparent);

        // Draw outer ellipse (representing the border)
        imagefilledellipse(
            $tempImage,
            $centerX - $ellipseXOffset,
            $centerY - $ellipseYOffset,
            $width  + $borderOuterStrength * 2,
            $height + $borderOuterStrength * 2,
            $color
        );

        // Draw inner ellipse (transparent area)
        imagefilledellipse(
            $tempImage,
            $centerX - $ellipseXOffset,
            $centerY - $ellipseYOffset,
            $width - $borderInnerStrength * 2,
            $height - $borderInnerStrength * 2,
            $transparent
        );

        // "Paste" ellipse (with transparent inner area) into image at original position
        imagealphablending($image, true);
        imagecopy(
            $image,
            $tempImage,
            $ellipseXOffset + ($borderWidth + 1) % 2,
            $ellipseYOffset + ($borderWidth + 1) % 2,
            0,
            0,
            $tempImageWidth,
            $tempImageHeight
        );
    }

?>
