<?php
// Output Buffer needed because of debug messages which create whitespace and thus prevent redirecting
ob_start();

// Connect to DB
$pdo = dbConnect();

// Fetch all categories for select
$statement = $pdo->prepare("SELECT * from categories");
$statement->execute();
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);
if ($statement->errorInfo()[2]) {
    logger("Error while fetching categories", $statement->errorInfo()[2]);
}

// Handle add category form
if (isset($_POST["addCategorySent"])) {
    logger("Category form was sent", $_POST["category"], LOGGER_INFO, LOGGER_TYPE_CONSOLE);

    // Escape field value and check for validity
    $formCategory = cleanString($_POST["category"]);
    $errorMessage = checkInputString($formCategory);

    // Check if category already exists
    if (!$errorMessage) {  // No errors
        // Make sure we have a db connection
        if (!isset($pdo)) {
            $pdo = dbConnect();
        }
        $statement = $pdo->prepare("SELECT COUNT(cat_name) FROM categories WHERE cat_name = :ph_category_name");
        $statement->execute([
            "ph_category_name" => $formCategory
        ]);
        if ($statement->errorInfo()[2]) {
            logger("Error while fetching category", $statement->errorInfo()[2]);
        }

        $count = $statement->fetchColumn();
        if ($count == 0) { // No entry found, save to db
            $statement = $pdo->prepare("INSERT INTO categories (cat_name) VALUES (:ph_category_name)");
            $statement->execute([
                "ph_category_name" => $formCategory
            ]);
            if ($statement->errorInfo()[2]) {
                logger("Error while inserting category", $statement->errorInfo()[2]);
            }

            $categoryRowCount = $statement->rowCount();
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
    logger("Blog form was sent", $_POST["category"], LOGGER_INFO, LOGGER_TYPE_CONSOLE);

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
            // Make sure we have a db connection
            if (!isset($pdo)) {
                $pdo = dbConnect();
            }

            $sqlQuery = "INSERT INTO blogs (blog_headline, blog_imagePath, blog_imageAlignment, blog_content, cat_id, usr_id)
                         VALUES (:ph_headline, :ph_imagepath, :ph_alignment, :ph_content, :ph_category, :ph_userid)";
            $sqlQueryMap = [
                "ph_headline" => $blogentry["headline"],
                "ph_imagepath" => ($imageUpload["path"] ?? NULL), // If upload was successfull take path otherwise NULL
                "ph_alignment" => $blogentry["imageAlignment"],
                "ph_content" => $blogentry["content"],
                "ph_category" => $blogentry["category"],
                "ph_userid" => cleanString($_SESSION["id"])
            ];

            $statement = $pdo->prepare($sqlQuery);
            $statement->execute($sqlQueryMap);
            if ($statement->errorInfo()[2]) {
                logger("Error while inserting into blogs", $statement->errorInfo()[2]);
            }

            $rowCount = $statement->rowCount();
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
