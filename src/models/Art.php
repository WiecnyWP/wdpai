<?php

class Art
{
    private $type;

    private $name;
    private $city;
    private $image;
    public function __construct($type, $name, $city, $image)
    {
        $this->type = $type;
        $this->name = $name;
        $this->city = $city;
        $this->image = $image;
    }

    public function getType() : string
    {
        return $this->type;
    }

    public function setType(string $type)
    {
        $this->type = $type;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getCity() : string
    {
        return $this->city;
    }

    public function setCity(string $city)
    {
        $this->city = $city;
    }

    public function getImage() : string
    {
        return $this->image;
    }

    public function setImage(string $image)
    {
        $this->image = $image;
    }

}