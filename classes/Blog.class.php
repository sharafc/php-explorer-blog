<?php

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

    public function __construct($headline, $content, $category, $user, $alignment, $path, $date, $id)
    {
        $this->setBlog_headline($headline);
        $this->setBlog_content($content);
        $this->setCategory($category);
        $this->setUser($user);
        $this->setBlog_imageAlignment($alignment);
        $this->setBlog_imagePath($path);
        $this->setBlog_date($date);
        $this->setBlog_id($id);
    }

    /**
     * Undocumented function
     *
     * @param PDO $pdo
     * @param [type] $categoryId
     * @return void
     */
    public static function fetchPostsFromDb(PDO $pdo, $categoryId = NULL, $blogpostId = NULL)
    {
        /*
        * Fetch blogposts
        * -> If category is set via action, only select blogposts from this category
        * -> if blogId is set via action, only select this blogpost to display
        */
        $query = 'SELECT * FROM blog
                  INNER JOIN user USING(usr_id)
                  INNER JOIN category USING(cat_id)'
                  . (isset($categoryId) ? ' WHERE cat_id = :ph_categoryId' : '')
                  . (isset($blogpostId) ? ' WHERE blog_id = :ph_blogId' : '')
                  . ' ORDER BY blog_date DESC';
        $statement = $pdo->prepare($query);

        // Execute query with map, depending on selected action
        if (isset($categoryId)) {
            $map = [
                'ph_categoryId' => $categoryId
            ];
            $statement->execute($map);
            if ($statement->errorInfo()[2]) {
                logger('Could not fetch blogposts with Category ID ' . $categoryId . ' from database', $statement->errorInfo()[2]);
            }
        } elseif (isset($blogpostId)) {
            $map = [
                'ph_blogId' => $blogpostId
            ];
            $statement->execute($map);
            if ($statement->errorInfo()[2]) {
                logger('Could not fetch blogpost with blogpost ID ' . $blogpostId . ' from database', $statement->errorInfo()[2]);
            }
        } else {
            $statement->execute();
            if ($statement->errorInfo()[2]) {
                logger('Could not fetch blogposts from database', $statement->errorInfo()[2]);
            }
        }

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
     * Undocumented function
     *
     * @param PDO $pdo
     * @return void
     */
    public function savePostToDb(PDO $pdo)
    {
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
            logger('Could not execute category check', $statement->errorInfo()[2]);
        }

        $rowCount = $statement->rowCount();
        if ($rowCount) {
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
     *
     * @return  self
     */
    public function setBlog_id($blog_id)
    {
        $this->blog_id = $blog_id;

        return $this;
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
     *
     * @return  self
     */
    public function setBlog_headline($blog_headline)
    {
        $this->blog_headline = $blog_headline;

        return $this;
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
     *
     * @return  self
     */
    public function setBlog_content($blog_content)
    {
        $this->blog_content = $blog_content;

        return $this;
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
     *
     * @return  self
     */
    public function setBlog_date($blog_date)
    {
        $this->blog_date = $blog_date;

        return $this;
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
     *
     * @return  self
     */
    public function setBlog_imageAlignment($blog_imageAlignment)
    {
        $this->blog_imageAlignment = $blog_imageAlignment;

        return $this;
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
     *
     * @return  self
     */
    public function setBlog_imagePath($blog_imagePath)
    {
        $this->blog_imagePath = $blog_imagePath;

        return $this;
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
     *
     * @return  self
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;

        return $this;
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
     *
     * @return  self
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }
}
