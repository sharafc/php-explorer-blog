<?php
require_once('./classes/CategoryInterface.class.php');
require_once('./classes/Category.class.php');
require_once('./classes/UserInterface.class.php');
require_once('./classes/User.class.php');
require_once('./classes/BlogInterface.class.php');
require_once('./classes/Blog.class.php');

// Fetch all categories for navigation
$categories = Category::fetchAllFromDb($pdo);

// Handle add category form
if (isset($_POST["addCategorySent"])) {
    // Escape field value and check for validity
    $formCategory = cleanString($_POST["category"]);
    $errorMessage = checkInputString($formCategory);


    if (!$errorMessage) {  // No errors

        // Check if category already exists

        $statement = $pdo->prepare("SELECT COUNT(cat_name) FROM category WHERE cat_name = :ph_category_name");
        $statement->execute([
            "ph_category_name" => $formCategory
        ]);
        if (DEBUG_DB) {
            if ($statement->errorInfo()[2]) {
                echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: " . $statement->errorInfo()[2] . " <i>(" . basename(__FILE__) . ")</i></p>\r\n";
            }
        }

        $count = $statement->fetchColumn();
        if (DEBUG) {
            echo "<p class='debug'><b>Line " . __LINE__ . "</b>: \$count: $count <i>(" . basename(__FILE__) . ")</i></p>\r\n";
        }
        if ($count == 0) { // No entry found, save to db
            $statement = $pdo->prepare("INSERT INTO category (cat_name) VALUES (:ph_category_name)");
            $statement->execute([
                "ph_category_name" => $formCategory
            ]);
            if (DEBUG_DB) {
                if ($statement->errorInfo()[2]) {
                    echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: " . $statement->errorInfo()[2] . " <i>(" . basename(__FILE__) . ")</i></p>\r\n";
                }
            }

            $categoryRowCount = $statement->rowCount();
            if (DEBUG) {
                echo "<p class='debug'><b>Line " . __LINE__ . "</b>: \$categoryRowCount: $categoryRowCount <i>(" . basename(__FILE__) . ")</i></p>\r\n";
            }

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
            if (DEBUG) {
                echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: Category already exists <i>(" . basename(__FILE__) . ")</i></p>\r\n";
            }
            $errorMessage = "Category already exists.";
        }
    } else { // Validation failed, there are errors in the form
        if (DEBUG) {
            echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: Category form is invalid <i>(" . basename(__FILE__) . ")</i></p>\r\n";
        }
    }
}

// Handle add blogpost form
if (isset($_POST["addBlogpostSent"])) {
    if (DEBUG) {
        echo "<p class='debug'><b>Line " . __LINE__ . "</b>: Blogpost form was send... <i>(" . basename(__FILE__) . ")</i></p>\r\n";
    }

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
        if (DEBUG) {
            echo "<p class='debug ok'><b>Line " . __LINE__ . "</b>: Blogpost form has no errors... <i>(" . basename(__FILE__) . ")</i></p>\r\n";
        }

        // Form has no field errors, handle image if exists
        if ($_FILES["image"]['tmp_name']) {
            if (DEBUG) {
                echo "<p class='debug'><b>Line " . __LINE__ . "</b>: Upload image... <i>(" . basename(__FILE__) . ")</i></p>\r\n";
            }

            $imageUpload = uploadImage($_FILES["image"]);
        } else {
            $imageUpload = NULL;
        }

        if (isset($imageUpload["error"])) { // Upload or image validation failed
            if (DEBUG) {
                echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: Image error in validation... <i>(" . basename(__FILE__) . ")</i></p>\r\n";
            }

            $errorImageUpload = $imageUpload["error"];
        } else { // Upload successfull or no image given -> process form
            if (DEBUG) {
                echo "<p class='debug'><b>Line " . __LINE__ . "</b>: No image error or no image given... <i>(" . basename(__FILE__) . ")</i></p>\r\n";
            }

            // Make sure we have a db connection
            if (!isset($pdo)) {
                $pdo = dbConnect();
            }

            $sqlQuery = "INSERT INTO blog (blog_headline, blog_imagePath, blog_imageAlignment, blog_content, cat_id, usr_id)
                         VALUES (:ph_headline, :ph_imagepath, :ph_alignment, :ph_content, :ph_category, :ph_userid)";
            if (DEBUG) {
                echo "<p class='debug'><b>Line " . __LINE__ . "</b>: \$sqlQuery: $sqlQuery <i>(" . basename(__FILE__) . ")</i></p>\r\n";
            }

            $sqlQueryMap = [
                "ph_headline" => $blogentry["headline"],
                "ph_imagepath" => ($imageUpload["path"] ?? NULL), // If upload was successfull take path otherwise NULL
                "ph_alignment" => $blogentry["imageAlignment"],
                "ph_content" => $blogentry["content"],
                "ph_category" => $blogentry["category"],
                "ph_userid" => cleanString($_SESSION["id"])
            ];
            if (DEBUG_ARRAY) {
                echo "<pre class='debug'>Line <b>" . __LINE__ . "</b> <i>(" . basename(__FILE__) . ")</i>:<br>\r\n";
                print_r($sqlQueryMap);
                echo "</pre>";
            }

            $statement = $pdo->prepare($sqlQuery);
            $statement->execute($sqlQueryMap);
            if (DEBUG_DB) {
                if ($statement->errorInfo()[2]) {
                    echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: " . $statement->errorInfo()[2] . " <i>(" . basename(__FILE__) . ")</i></p>\r\n";
                }
            }

            $rowCount = $statement->rowCount();
            if (DEBUG) {
                echo "<p class='debug'><b>Line " . __LINE__ . "</b>: \$rowCount: $rowCount <i>(" . basename(__FILE__) . ")</i></p>\r\n";
            }

            if ($rowCount) { // INSERT successfull
                $blogpostId = $pdo->lastInsertId();
                if (DEBUG) {
                    echo "<p class='debug ok'><b>Line " . __LINE__ . "</b>: Blogpast saved with $blogpostId. <i>(" . basename(__FILE__) . ")</i></p>\r\n";
                }

                $transactionResultState = [
                    "state" => "success",
                    "message" => "Blogpost with ID $blogpostId saved to database."
                ];

                // Clear form fields
                $blogentry = [];
            } else { // INSERT failed
                if (DEBUG) {
                    echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: Error while saving <i>(" . basename(__FILE__) . ")</i></p>\r\n";
                }
                $transactionResultState = [
                    "state" => "error",
                    "message" => "Something went wrong. Please try again later."
                ];
            }
        }
    } else { // Validation failed, there are errors in the form
        if (DEBUG) {
            echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: Blogpost form has errors... <i>(" . basename(__FILE__) . ")</i></p>\r\n";
        }
        if (DEBUG_ARRAY) {
            echo "<pre class='debug'>Line <b>" . __LINE__ . "</b> <i>(" . basename(__FILE__) . ")</i>:<br>\r\n";
            print_r($blogentry);
            echo "</pre>";
        }
    }
}

// Delegate view
require_once('./views/dashboard.inc.php');