<?php
//cropimage.php?filename=a.jpg&newxsize=100&newysize=200&constrain=1
namespace v3;

echo $_REQUEST['filename'];
$basefilename = @basename(urldecode($_REQUEST['filename']));

$path = @parse_str(urldecode($_REQUEST['filename']));
print_r($path);

if(is_dir("crop_images"))
{
    @mkdir("crop_images");
}
$path = 'data/';
$outPath = 'crop_images/';
$saveOutput = true; // true/false ("true" if you want to save images in out put folder)
$defaultImage = 'no_img.png'; // change it with your default image

$basefilename = $basefilename;
$w = $_REQUEST['newxsize'];
$h = $_REQUEST['newysize'];

if ($basefilename == "") {
    $img = $path . $defaultImage;
    $percent = 100;
} else {
    $img = $path . $basefilename;

    $len = strlen($img);
    $ext = substr($img, $len - 3, $len);
    $img2 = substr($img, 0, $len - 3) . strtoupper($ext);
    if (!file_exists($img)) $img = $img2;
    if (file_exists($img)) {
        $percent = @$_GET['percent'];
        $constrain = @$_GET['constrain'];
        $w = $w;
        $h = $h;
    } else if (file_exists($path . $basefilename)) {
        $img = $path . $basefilename;
        $percent = $_GET['percent'];
        $constrain = $_GET['constrain'];
        $w = $w;
        $h = $h;
    } else {

        $img = $path . 'no_img.png';    // change with your default image
        $percent = @$_GET['percent'];
        $constrain = @$_GET['constrain'];
        $w = $w;
        $h = $h;

    }

}

// get image size of img
$x = @getimagesize($img);

// image width
$sw = $x[0];
// image height
$sh = $x[1];

if ($percent > 0) {
    // calculate resized height and width if percent is defined
    $percent = $percent * 0.01;
    $w = $sw * $percent;
    $h = $sh * $percent;
} else {
    if (isset ($w) AND !isset ($h)) {
        // autocompute height if only width is set
        $h = (100 / ($sw / $w)) * .01;
        $h = @round($sh * $h);
    } elseif (isset ($h) AND !isset ($w)) {
        // autocompute width if only height is set
        $w = (100 / ($sh / $h)) * .01;
        $w = @round($sw * $w);
    } elseif (isset ($h) AND isset ($w) AND isset ($constrain)) {
        // get the smaller resulting image dimension if both height
        // and width are set and $constrain is also set
        $hx = (100 / ($sw / $w)) * .01;
        $hx = @round($sh * $hx);

        $wx = (100 / ($sh / $h)) * .01;
        $wx = @round($sw * $wx);

        if ($hx < $h) {
            $h = (100 / ($sw / $w)) * .01;
            $h = @round($sh * $h);
        } else {
            $w = (100 / ($sh / $h)) * .01;
            $w = @round($sw * $w);
        }
    }
}

$im = @ImageCreateFromJPEG($img) or // Read JPEG Image
$im = @ImageCreateFromPNG($img) or // or PNG Image
$im = @ImageCreateFromGIF($img) or // or GIF Image
$im = false; // If image is not JPEG, PNG, or GIF

if (!$im) {
    // We get errors from PHP's ImageCreate functions...
    // So let's echo back the contents of the actual image.
    readfile($img);
} else {
    // Create the resized image destination
    $thumb = @ImageCreateTrueColor($w, $h);
    // Copy from image source, resize it, and paste to image destination
    @ImageCopyResampled($thumb, $im, 0, 0, 0, 0, $w, $h, $sw, $sh);

    //Other format imagepng()

    if ($saveOutput) { //Save image
        $save = $outPath . $basefilename;
        @ImageJPEG($thumb, $save);
    } else { // Output resized image
        header("Content-type: image/jpeg");
        @ImageJPEG($thumb);
    }
}