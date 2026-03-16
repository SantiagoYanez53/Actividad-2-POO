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

    public function getDetails() {
        return "[$this->marca] Modelo: {$this->model}, Precio: {$this->price}";
    } 

}

class ElectricGuitar extends Guitar {
    public $hasFloydRose;

    public function __construct($model, $marca, $price, $hasFloydRose) {
        parent:: __construct($model, $marca, $price);
        $this->hasFloydRose = $hasFloydRose;
    }

    public function getDetails() {
        $puente = $this->hasFloydRose ? "Con Floyd Rose" : "Puente Fijo";
        return parent::getDetails() . " - Tipo: Electrica ($puente)";
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
            echo " - " . $guitar->getDetails();
            $encontrado = true;
        };
    }
    if (!$encontrado){
        echo " No encontramos la marca solicitada";
    };
    
    }
}

$miInventario = new Inventory();

$g1 = new ElectricGuitar("Player II Stratocaster", "Fender", 800, false);
$g2 = new ElectricGuitar("Telecaster", "Fender", 750,false);
$g3 = new ElectricGuitar("Les Paul", "Gibson", 2000,false);
$g4 = new ElectricGuitar("Flying V", "Jackson", 17800,true);

$miInventario->add($g1);
$miInventario->add($g2);
$miInventario->add($g3);
$miInventario->add($g4);


$miInventario->showModel("Fender");

?>

