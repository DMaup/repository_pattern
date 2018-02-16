<?php
class Product extends Model {

    private $label;
    private $price;
    private $image_url;

    //Label
    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($label)
    {
        $this->label = $label;
    }

    //Price
    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = (float) $price;
    }

    //Image_url
    public function getImage_url()
    {
        return $this->image_url;
    }

    public function setImage_url($image_url)
    {
        $this->image_url = $image_url;
    }

}
