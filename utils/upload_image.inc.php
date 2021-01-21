<?php

/**
 * Generic image upload
 *
 * Allows you to upload an image with helpful defaults.
 *
 * Basic usage:
 * uploadImage($_FILES[filename]);
 *
 * @param array $uploadedImage the uploaded image with all its properties.
 * @param int (optional) $imageMaxHeight the maximum allowed height. Defaults to IMAGE_MAX_HEIGHT
 * @param int (optional) $imageMaxWidth the maximum allowed width. Defaults to IMAGE_MAX_WIDTH
 * @param int (optional) $imageMaxSize the maximum allowed filesize. Defaults to IMAGE_MAX_SIZE
 * @return array processedImagePath Array containing the processed imagePath and the error message if applicable
 * [
 *      'path' => (string) $fileTargetPath,
 *      'error' => (string) $errorMessage
 * ]
 */
function uploadImage(
    $image,
    $imageMaxHeight = IMAGE_MAX_HEIGHT,
    $imageMaxWidth = IMAGE_MAX_WIDTH,
    $imageMaxSize = IMAGE_MAX_SIZE
) {
    // Constants mapping and initialization
    $uploadPath = IMAGE_UPLOADPATH;
    $allowedMimeTypes = IMAGE_ALLOWED_MIMETYPES;

    // Map temporary upload path, filename and size
    $fileTempPath = $image['tmp_name'];
    $fileNameOriginal = cleanString($image['name']);
    $fileSize = $image['size'];

    // Extracting file name and type
    $fileInfo = pathinfo($fileNameOriginal);
    $fileType = $fileInfo['extension'];
    $fileNameQualified = $fileInfo['filename'];

    // Sanitize and convert to 'server safe' file name
    $fileNameQualified = str_replace(' ', '_', $fileNameQualified);
    $fileNameQualified = mb_strtolower($fileNameQualified);
    $fileNameQualified = str_replace(array('ä', 'ö', 'ü', 'ß'), array('ae', 'oe', 'ue', 'ss'), $fileNameQualified);
    $fileNameQualified = preg_replace('/[^a-z0-9_-]/', '', $fileNameQualified);

    // Create random prefix to really have a unique filename
    $fileNamePrefix = rand(1, 999999) . str_shuffle('abcdefghijklmnopqrstuvwxyz') . time();

    // Concatinate all info to one file path
    $fileTargetPath = $uploadPath . DIRECTORY_SEPARATOR . $fileNamePrefix . '_' . $fileNameQualified . DELIMITER_FILE . $fileType;

    // Validate image dimensions, size and allowed mimetypes
    $imageData = getimagesize($fileTempPath);
    $imageWidth = $imageData[0];
    $imageHeight = $imageData[1];
    $imageMimeType = $imageData['mime'];

    if (!in_array($imageMimeType, $allowedMimeTypes)) { // Check for allowed mime types
        $errorMessage = 'Not an allowed Mime type';
    } elseif ($imageHeight > $imageMaxHeight) { // Check for allowed image height
        $errorMessage = 'Image height exceeds the allowed height of $imageMaxHeight pixel';
    } elseif ($imageWidth > $imageMaxWidth) { // Check for allowed image width
        $errorMessage = 'Image width exceeds the allowed width of $imageMaxWidth pixel';
    } elseif ($fileSize > $imageMaxSize) { // Check for allowed file size
        $errorMessage = 'File size exceeds the allowd size of ' . round($imageMaxSize / 1024, 2) . 'kB';
    } else { // No errors
        $errorMessage = NULL;
    }

    // Move file and validate save
    if (!$errorMessage) {
        // Save image to disk
        if (!@move_uploaded_file($fileTempPath, $fileTargetPath)) {
            logger('Error while moving file from $fileTempPath to $fileTargetPath.');

            $fileTargetPath = NULL;
        }
    } else {
        // User needs to reselect image since the given one didn't comply
        $fileTargetPath = NULL;
    }

    return array('path' => $fileTargetPath, 'error' => $errorMessage);
}
