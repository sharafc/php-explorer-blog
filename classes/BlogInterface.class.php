<?php

interface BlogInterface
{
    public function __construct($headline, $content, $category, $user, $alignment, $path, $date, $id);

    public static function fetchPostsFromDb(PDO $pdo, $categoryId = NULL);

    public function savePostToDb(PDO $pdo);

    public function getBlog_id();
    public function setBlog_id($blog_id);
    public function getBlog_headline();
    public function setBlog_headline($blog_headline);
    public function getBlog_content();
    public function setBlog_content($blog_content);
    public function getBlog_date();
    public function setBlog_date($blog_date);
    public function getBlog_imageAlignment();
    public function setBlog_imageAlignment($blog_imageAlignment);
    public function getBlog_imagePath();
    public function setBlog_imagePath($blog_imagePath);
    public function getCategory();
    public function setCategory(Category $category);
    public function getUser();
    public function setUser(User $user);

}
