<?php
class Category {
    private $id_category;
    private $name_category;
    private $des;

    public function __construct($id_category, $name_category, $des) {
        $this->id_category = $id_category;
        $this->name_category = $name_category;
        $this->des = $des;
    }

    public function getIdCategory() { return $this->id_category; }
    public function getNameCategory() { return $this->name_category; }
    public function getDes() { return $this->des; }
}