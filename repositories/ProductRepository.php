<?php 
class ProductRepository extends Repository {

    const PRODUCT_BY_PAGE = 10;

    private function createProduct( Product $product ){
        
        $sql = "INSERT INTO products 
                SET label=:label, 
                    price=:price, 
                    image_url=:image_url";
        
        $params = [
            "label"     => $product->getLabel(),
            "price"     => $product->getPrice(),
            "image_url" => $product->getImage_url()
        ];
        
        return $this->create( $sql, $params, $product );

    }

    private function updateProduct( Product $product ){

        $sql = "UPDATE products 
                SET label=:label, 
                    price=:price, 
                    image_url=:image_url
                WHERE id=:id";

        $params = [
            "label"     => $product->getLabel(),
            "price"     => $product->getPrice(),
            "image_url" => $product->getImage_url()
        ];

        return $this->update( $sql, $params, $product );

    }

    protected function save( Model $product ){
        // Cas 1 : Pas d'id renseigné, je souhaite insérer mon produit
        if( empty( $product->getId() ) ){
            return $this->createProduct( $product );
        }
        //Cas 2 : id renseigné, je cherche a mettre à jour mon produit
        else {
            return $this->updateProduct( $product );
        }
    }
    
    public function saveProduct( Product $product ){
        return $this->save( $product );
    }

    public function getProductById( $id ) {

        $sql = "SELECT * FROM products WHERE id=:id";
        $params = [
            "id" => $id
        ];
        $data = $this->read( $sql, $id );
        
        $product = false;

        if( $data ){
            $product = new Product( $data );
        }
        
        return $product;

    }

    public function deleteProduct( $id ){

        $sql = "DELETE FROM products WHERE id=:id";
        return $this->delete( $sql, $id );

    }

    public function getProducts( $start_index = 0 ){

        $sql = "SELECT * FROM products LIMIT :start_index, :per_page";
        $params = [
            ':start_index' => $start_index,
            ':per_page' => self::PRODUCT_BY_PAGE
        ];

        $datas = $this->readAll( $sql, $params );

        $products = [];
        
        foreach ( $datas as $data ) {
            
            $products[] = new Product( $data );

        }

        return $products;

    }

}