<?php

use RepositoryManager as RM;

class ProductController extends Controller{
    public function displayAll( $page ){

        $start_index = 0;
            if($page){
                $start_index = $page * ProductRepository::PRODUCT_BY_PAGE;
            }

        $productRepository = $this->RM->getProductRepository();
        $products = $productRepository->getProducts($start_index);

        var_dump( $products );
    }

    public function displayCreateForm(){
        $errors = $this->getRegisteredErrors();
        
        $product = $this->getRegisteredDatas() ?? new Product;
    
        Flight::render("products/create_edit", [
            "product"=>$product,
            "errors" => $errors
        ]);
    }

    public function displayEditForm($id){
        $errors = $this->getRegisteredErrors();
    
        $product = $this->getRegisteredDatas();
       
            if(!$product){
                $productRepository = $this->RM->getProductRepository();

                $product = $productRepository->getProductById($id);
            }

            if($product){
                Flight::render("products/create_edit", [
                    "product"=>$product,
                    "errors" => $errors
                ]);
            }   
    }

    public function diplaySaveProduct(){
        $datas = Flight::request()->data->getData();
        $product = new Product( $datas );

        $formValidator = new ProductFormValidator($datas);

        if(!$formValidator->check()){
            
            $this->getRegisteredErrors($formValidator->getErrors());
            $this->getRegisteredFormDatas($user);

                if($id = $product->getId()){
                    Flight::redirect("/products/edit/".$id);
                }
                else{
                    Flight::redirect("/products/create");
                }
            Flight::redirect("/products/create");
            return;
        }
    
    $formValidator->getErrors();

    $repository = $this->RM->getProductRepository();

            if( $repository->saveProduct( $product ) ){
                echo "Produit ". $product->getId() . " mis à jour";
            }
            else {
                echo "Echec de l'insertion";
            }

    }

    public function displayDeleteProduct($id){
        $productRepository = $this->RM->getProductRepository();

        if( $productRepository->deleteProduct( $id ) ){
            echo "Le produit " . $id . " a bien été supprimé";
        }
        else {
            echo "Le produit " . $id . " n'a pas pu être supprimé";
        }


    }

    public function displayReadProduct($id){
        $productRepository = $this->RM->getProductRepository();
        $product = $productRepository->getProductById( $id );
    
        if( $product ){
            var_dump( $product );
        }
        else {
            echo "Le produit " . $id . " n'existe pas";
        }
    
    
    }
    
    
}

