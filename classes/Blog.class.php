<?php

/**
 * Represents a blogpost with all its entities.
 * Needs a Category and User class
 *
 * @implements BlogInterface
 *
 * @author Christian Sharaf
 * @copyright 2021 Christian Sharaf
 * @version 1.0.0
 */
class Blog implements BlogInterface
{
    private $blog_id;
    private $blog_headline;
    private $blog_content;
    private $blog_date;
    private $blog_imageAlignment;
    private $blog_imagePath;
    private Category $category;
    private User $user;

    /**
     * @construct
     *
     * @param string $headline Headline of the blogpost
     * @param string $content Content of the blogpost
     * @param Category $category The category the blogpost belongs to
     * @param User $user The user who wrote the blogpost
     * @param string $alignment The alignment of the image
     * @param string $path The path to the image
     * @param string $date The creation date of the blogpost
     * @param integer $id The blogpost id
     */
    public function __construct($headline = NULL, $content = NULL, Category $category = NULL, User $user = NULL, $alignment = NULL, $path = NULL, $date = NULL, $id = NULL)
    {
        $this->setBlog_headline($headline);
        $this->setBlog_content($content);
        $this->setCategory($category);
        $this->setUser($user);
        $this->setBlog_imageAlignment($alignment);
        $this->setBlog_imagePath($path);
        $this->setBlog_date($date);
        $this->setBlog_id($id);

        if (DEBUG_CC) {
            echo "<h3 class='debugClass hint'><b>Line " . __LINE__ .  "</b>: Call of " . __METHOD__ . "()  (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
        }
    }

    /**
     * Fetches blogposts from the database. With the optional parameters you are able to
     * either fetch only posts by category or a single post by id
     *
     * @param PDO $pdo The PHP database object
     * @param integer (optional) $categoryId The category to select from
     * @param integer (optional) $blogpostId The blogpost id to fetch
     * @return array $blogPosts Array containing Blog objects which represent our blogposts
     */
    public static function fetchPostsFromDb(PDO $pdo, $categoryId = NULL, $blogpostId = NULL)
    {
        if (DEBUG_C) {
            echo "<h3 class='debugClass'><b>Line  " . __LINE__ .  "</b>: Call to " . __METHOD__ . "() (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
        }

        /*
        * Build sql query
        * -> If category is set via action, only select blogposts from this category
        * -> if blogId is set via action, only select given blogpost to display
        */
        $query = 'SELECT * FROM blog
                  INNER JOIN user USING(usr_id)
                  INNER JOIN category USING(cat_id)'
                  . (isset($categoryId) ? ' WHERE cat_id = :ph_categoryId' : '')
                  . (isset($blogpostId) ? ' WHERE blog_id = :ph_blogId' : '')
                  . ' ORDER BY blog_date DESC';
        $statement = $pdo->prepare($query);
        // Execute query with map, depending on given parameters
        if (isset($categoryId)) {
            $map = [
                'ph_categoryId' => $categoryId
            ];
            $statement->execute($map);
            if ($statement->errorInfo()[2]) {
                logger('Could not fetch blogposts with Category ID ' . $categoryId . ' from database', $statement->errorInfo()[2]);
                if (DEBUG_DB) {
                    echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: " . $statement->errorInfo()[2] . " <i>(" . basename(__FILE__) . ")</i></p>\r\n";
                }
            }
            if (DEBUG) {
                echo "<p class='debugDb'><b>Line " . __LINE__ . ":</b> Fetching blogposts with category $categoryId... <i>(" . basename(__FILE__) . ")</i></p>\r\n";
            }
        } elseif (isset($blogpostId)) {
            $map = [
                'ph_blogId' => $blogpostId
            ];
            $statement->execute($map);
            if ($statement->errorInfo()[2]) {
                logger('Could not fetch blogpost with blogpost ID ' . $blogpostId . ' from database', $statement->errorInfo()[2]);
                if (DEBUG_DB) {
                    echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: " . $statement->errorInfo()[2] . " <i>(" . basename(__FILE__) . ")</i></p>\r\n";
                }
            }
            if (DEBUG) {
                echo "<p class='debugDb'><b>Line " . __LINE__ . ":</b> Fetching blogpost with id $blogpostId... <i>(" . basename(__FILE__) . ")</i></p>\r\n";
            }
        } else {
            $statement->execute();
            if ($statement->errorInfo()[2]) {
                logger('Could not fetch blogposts from database', $statement->errorInfo()[2]);
                if (DEBUG_DB) {
                    echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: " . $statement->errorInfo()[2] . " <i>(" . basename(__FILE__) . ")</i></p>\r\n";
                }
            }
            if (DEBUG) {
                echo "<p class='debugDb'><b>Line " . __LINE__ . ":</b> Fetching all blogposts ... <i>(" . basename(__FILE__) . ")</i></p>\r\n";
            }
        }

        $blogPosts = [];

        while ($result = $statement->fetch(PDO::FETCH_ASSOC)) {
            $blogPosts[] = new Blog(
                $result['blog_headline'],
                $result['blog_content'],
                new Category($result['cat_id'], $result['cat_name']),
                new User($result['usr_firstname'], $result['usr_lastname'], $result['usr_email'], $result['usr_password'],  $result['usr_city'], $result['usr_id']),
                $result['blog_imageAlignment'],
                $result['blog_imagePath'],
                $result['blog_date'],
                $result['blog_id']
            );
        }

        return $blogPosts;
    }

    /**
     * Save a blogpost to the database
     *
     * @param PDO $pdo The PHP database object
     * @return bool True when saving was successful, otherwise false
     */
    public function savePostToDb(PDO $pdo)
    {
        if (DEBUG_C) {
            echo "<h3 class='debugClass'><b>Line  " . __LINE__ .  "</b>: Call to " . __METHOD__ . "() (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
        }

        $query = 'INSERT INTO blog (blog_headline, blog_imagePath, blog_imageAlignment, blog_content, cat_id, usr_id)
                  VALUES (:ph_headline, :ph_imagepath, :ph_alignment, :ph_content, :ph_category, :ph_userid)';
        $map = [
            'ph_headline' => $this->getBlog_headline(),
            'ph_imagepath' => $this->getBlog_imagePath(),
            'ph_alignment' => $this->getBlog_imageAlignment(),
            'ph_content' => $this->getBlog_content(),
            'ph_category' => $this->getCategory()->getCat_id(),
            'ph_userid' => $this->getUser()->getUsr_id()
        ];

        $statement = $pdo->prepare($query);
        $statement->execute($map);
        if ($statement->errorInfo()[2]) {
            logger('Could not save blogpost to database', $statement->errorInfo()[2]);
            if (DEBUG_DB) {
                echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: " . $statement->errorInfo()[2] . " <i>(" . basename(__FILE__) . ")</i></p>\r\n";
            }
        }

        $rowCount = $statement->rowCount();
        if ($rowCount) {
            $lastInsertId = $pdo->lastInsertId();
            $this->setBlog_id($lastInsertId);
            logger('Saving successful. Blogpost saved with ID: ', $lastInsertId, LOGGER_INFO);

            return true;
        }

        return false;
    }

    /**
     * Get the value of blog_id
     */
    public function getBlog_id()
    {
        return $this->blog_id;
    }

    /**
     * Set the value of blog_id
     */
    public function setBlog_id($blog_id)
    {
        $this->blog_id = $blog_id;
    }

    /**
     * Get the value of blog_headline
     */
    public function getBlog_headline()
    {
        return $this->blog_headline;
    }

    /**
     * Set the value of blog_headline
     */
    public function setBlog_headline($blog_headline)
    {
        $this->blog_headline = $blog_headline;
    }

    /**
     * Get the value of blog_content
     */
    public function getBlog_content()
    {
        return $this->blog_content;
    }

    /**
     * Set the value of blog_content
     */
    public function setBlog_content($blog_content)
    {
        $this->blog_content = $blog_content;
    }

    /**
     * Get the value of blog_date
     */
    public function getBlog_date()
    {
        return $this->blog_date;
    }

    /**
     * Set the value of blog_date
     */
    public function setBlog_date($blog_date)
    {
        $this->blog_date = $blog_date;
    }

    /**
     * Get the value of blog_imageAlignment
     */
    public function getBlog_imageAlignment()
    {
        return $this->blog_imageAlignment;
    }

    /**
     * Set the value of blog_imageAlignment
     */
    public function setBlog_imageAlignment($blog_imageAlignment)
    {
        $this->blog_imageAlignment = $blog_imageAlignment;
    }

    /**
     * Get the value of blog_imagePath
     */
    public function getBlog_imagePath()
    {
        return $this->blog_imagePath;
    }

    /**
     * Set the value of blog_imagePath
     */
    public function setBlog_imagePath($blog_imagePath)
    {
        $this->blog_imagePath = $blog_imagePath;
    }

    /**
     * Get the value of category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Get the value of user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }
}
