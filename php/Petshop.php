<?php
class Petshop
{
    // atribut private
    private $id;
    private $name;
    private $category;
    private $price;
    private $image;

    // konstruktor dengan parameter untuk mengisi nilai
    public function __construct($id, $name, $category, $price, $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
        $this->price = $price;
        $this->image = $image;
    }

    // getter dan setter untuk id
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    // getter dan setter untuk name
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    // getter dan setter untuk category
    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    // getter dan setter untuk price
    public function setPrice($price)
    {
        $this->price = $price;
    }
    
    public function getPrice()
    {
        return $this->price;
    }

    // getter dan setter untuk image
    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    function __destruct() {}
}
