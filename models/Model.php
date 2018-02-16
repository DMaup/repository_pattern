<?php 
abstract class Model {

    protected $id;

    function __construct( array $datas = [] ){

        $this->hydrate( $datas );

    }

    //Id
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = (int) $id;
    }

    // On va avoir en entré un tableau associatif type : 
    //     [
    //         "id" => 1,
    //         "label" => "patate",
    //         "price" => 10,
    //         "image_url" => "mon_url.png",
    //          "madatasup" => 78985959529256256
    //     ]
    private function hydrate( array $datas ){

        foreach( $datas as $key => $value ){

            //On cherche une méthode de setter correspondante
            $method = "set" . ucfirst($key); //setId

            //On vérifie que le setter existe sur cet objet
            if( method_exists( $this, $method ) ){

                // Interprété en $this->setId( $value )
                $this->$method( $value );

            }


        }

    }

}