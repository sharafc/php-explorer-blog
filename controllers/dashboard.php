<?php
require_once("./models/categories.inc.php");
// Fetch all categories for select
$categories = getAllCategories();

// Handle add category form
if (isset($_POST["addCategorySent"])) {
    logger("Category form was sent", $_POST["category"], LOGGER_INFO, LOGGER_TYPE_CONSOLE);

    // Escape field value and check for validity
    $formCategory = cleanString($_POST["category"]);
    $errorMessage = checkInputString($formCategory);

    // Check if category already exists
    if (!$errorMessage) {  // No errors

        $count = countCategoriesByName($formCategory);

        if ($count == 0) { // No entry found, save to db

            $categoryRowCount = insertCategoryByName($formCategory);

            if ($categoryRowCount) { // INSERT successfull
                $transactionResultState = [
                    "state" => "success",
                    "message" => "Category $formCategory saved to database."
                ];

                // Empty form field
                $formCategory = NULL;
            } else { // INSERT went wrong
                $transactionResultState = [
                    "state" => "error",
                    "message" => "Something went wrong. Please try again later."
                ];
            }
        } else { // Category already exists
            $errorMessage = "Category already exists.";
        }
    }
}

// Handle add blogpost form
if (isset($_POST["addBlogpostSent"])) {
    logger("Blog form was sent", $_POST["blogentry"], LOGGER_INFO, LOGGER_TYPE_CONSOLE);

    // Clean post array values of potential risks
    foreach ($_POST["blogentry"] as $key => $value) {
        $blogentry[$key] = cleanString($value);
    }

    // Validate fields and assign errors
    $error = [
        "headline" => checkInputString($blogentry["headline"]),
        "content" => checkInputString($blogentry["content"], 200, 40000)
    ];

    // Remove whitespaces and empty values from error array
    $errorMap = array_map('trim', $error);
    $errorMap = array_filter($errorMap);

    // Triple operator check since we really want to check on int 0 since the count returns an integer
    if (count($errorMap) === 0) { // No errors
        // Form has no field errors, handle image if exists
        if ($_FILES["image"]['tmp_name']) {
            logger("Uploading image", $_FILES["image"]['tmp_name'], LOGGER_INFO, LOGGER_TYPE_CONSOLE);
            $imageUpload = uploadImage($_FILES["image"]);
        } else {
            $imageUpload = NULL;
        }

        if (isset($imageUpload["error"])) { // Upload or image validation failed
            $errorImageUpload = $imageUpload["error"];
        } else { // Upload successfull or no image given -> process form

            $rowCount = insertBlogpost($blogentry, ($imageUpload["path"] ?? NULL));

            if ($rowCount) { // INSERT successfull
                $blogpostId = $pdo->lastInsertId();
                logger("Blogpost saved with:", $blogpostId, LOGGER_INFO, LOGGER_TYPE_CONSOLE);

                $transactionResultState = [
                    "state" => "success",
                    "message" => "Blogpost with ID $blogpostId saved to database."
                ];

                // Clear form fields
                $blogentry = [];
            } else { // INSERT failed
                $transactionResultState = [
                    "state" => "error",
                    "message" => "Something went wrong. Please try again later."
                ];
            }
        }
    }
}
