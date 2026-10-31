<?php
class Book {
    private $id_book;
    private $id_category;
    private $title;
    private $author;
    private $publisher;
    private $publish_year;
    private $quantity;
    private $cover_image;
    private $des;
    private $category_name;

    public function __construct($data = []) {
        $this->id_book      = $data['id_book'] ?? null;
        $this->id_category  = $data['id_category'] ?? null;
        $this->title        = $data['title'] ?? '';
        $this->author       = $data['author'] ?? '';
        $this->publisher    = $data['publisher'] ?? '';
        $this->publish_year = $data['publish_year'] ?? '';
        $this->quantity     = $data['quantity'] ?? 0;
        $this->cover_image  = $data['cover_image'] ?? '';
        $this->des          = $data['des'] ?? '';
        $this->category_name = $data['category_name'] ?? '';
    }

    public function getIdBook() { return $this->id_book; }
    public function getIdCategory() { return $this->id_category; }
    public function getTitle() { return $this->title; }
    public function getAuthor() { return $this->author; }
    public function getPublisher() { return $this->publisher; }
    public function getPublishYear() { return $this->publish_year; }
    public function getQuantity() { return $this->quantity; }
    public function getCoverImage() { return $this->cover_image; }
    public function getDes() { return $this->des; }
    public function getCategoryName() { return $this->category_name; }
}