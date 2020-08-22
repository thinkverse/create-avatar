<?php // @phpcs:disable

if (!function_exists('createDefaultAvatar')) {
    function createDefaultAvatar(
        string $text = 'DEV',
        array $bgColor = [0, 0, 0],
        array $textColor = [255, 255, 255],
        int $fontSize = 140,
        int $width = 600,
        int $height = 600,
        string $font = './arial.ttf'
    ) {
        $image = @imagecreate($width, $height)
            or die("Cannot Initialize new GD image stream");

        imagecolorallocate($image, $bgColor[0], $bgColor[1], $bgColor[2]);

        $fontColor = imagecolorallocate($image, $textColor[0], $textColor[1], $textColor[2]);

        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);

        $y = abs(ceil(($height - $textBoundingBox[5]) / 2));
        $x = abs(ceil(($width - $textBoundingBox[2]) / 2));

        imagettftext($image, $fontSize, 0, $x, $y, $fontColor, $font, $text);

        return $image;
    }
}

$img = createDefaultAvatar();

header("Content-Type: image/png");

imagepng($img);
imagedestroy($img);
