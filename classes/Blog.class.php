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

    public function __construct()
    {

    }

    public static function fetchPostsFromDb(PDO $pdo, $categoryId = NULL) {

    }

    public function savePostToDb(PDO $pdo) {

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