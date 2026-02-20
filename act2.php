<?php

/* 
En esta actividad haremos un inventario de guitarras en donde se podra obtener modelo, precio y marca
*/

class Guitar {
    public $model;
    public $marca;
    public $price;

    public function __construct($model, $marca, $price) {
        $this->model = $model;
        $this->marca = $marca;
        $this->price = $price;
    }
}

class Inventory {
    public $lista = [];

    public function add(Guitar $guitar)  {
        $this->lista[] =$guitar;
    }

    public function showModel($marcaBuscada) {
        echo "Modelos disponibles " . $marcaBuscada ;
        $encontrado = false;

        foreach ($this->lista as $guitar) {
        if (strtolower($guitar->marca) == strtolower($marcaBuscada)) {
            echo " 
            - " . $guitar->model . " (Precio: $" . $guitar->price . ")";
            $encontrado = true;
        };
    }
    if (!$encontrado){
        echo " No encontramos la marca solicitada";
    };
    
    }
}

$miInventario = new Inventory();

$g1 = new Guitar("Player II Stratocaster", "Fender", 800);
$g2 = new Guitar("Telecaster", "Fender", 750);
$g3 = new Guitar("Les Paul", "Gibson", 2000);

$miInventario->add($g1);
$miInventario->add($g2);
$miInventario->add($g3);


$miInventario->showModel("Fender");

?>

