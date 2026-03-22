<?php

// 1. INTERFAZ: Define un "contrato". Cualquier cosa vendible DEBE tener este método.
interface Vendible {
    public function aplicarDescuento($porcentaje);
}

// 2. CLASE ABSTRACTA: No puedes crear un "Producto" a secas, debe ser una subclase.
// Cambiamos 'Guitar' por 'Producto' para cumplir con el esquema de la tarea.
abstract class Producto {
    public $model;
    public $marca;
    public $price;

    public function __construct($model, $marca, $price) {
        $this->model = $model;
        $this->marca = $marca;
        $this->price = $price;
    }

    // MÉTODO ABSTRACTO: Obligamos a todas las subclases a tener su propia forma de mostrar detalles.
    abstract public function getDetails();
}

// 3. SUBCLASE: Implementa la herencia y la interfaz.
class ElectricGuitar extends Producto implements Vendible {
    public $hasFloydRose;

    public function __construct($model, $marca, $price, $hasFloydRose) {
        parent::__construct($model, $marca, $price);
        $this->hasFloydRose = $hasFloydRose;
    }

    // Implementación del método abstracto (Polimorfismo)
    public function getDetails() {
        $puente = $this->hasFloydRose ? "Con Floyd Rose" : "Puente Fijo";
        // Nota: ya no usamos parent::getDetails porque el padre es abstracto y no tiene cuerpo.
        return "[{$this->marca}] Modelo: {$this->model}, Precio: {$this->price} - Tipo: Electrica ($puente)";
    }

    // Implementación de la Interfaz
    public function aplicarDescuento($porcentaje) {
        $descuento = $this->price * ($porcentaje / 100);
        $this->price -= $descuento;
        return "Descuento aplicado del $porcentaje%. Nuevo precio: $" . $this->price;
    }
}

// 4. INVENTARIO: Ahora maneja "Productos" (Polimorfismo puro)
class Inventory {
    public $lista = [];

    // Ahora acepta cualquier objeto que herede de Producto
    public function add(Producto $producto) {
        $this->lista[] = $producto;
    }

    public function showModel($marcaBuscada) {
        echo " Resultados para la marca: " . $marcaBuscada ;
        $encontrado = false;

        foreach ($this->lista as $item) {
            if (strtolower($item->marca) == strtolower($marcaBuscada)) {
                // Aquí ocurre el polimorfismo: no importa qué tipo de producto sea,
                // llamamos a getDetails() y el objeto sabe qué responder.
                echo " - " . $item->getDetails();
                $encontrado = true;
            }
        }
        if (!$encontrado) {
            echo "No encontramos la marca solicitada.";
        }
    }
}

// --- PROGRAMA PRINCIPAL ---

$miInventario = new Inventory();

// Instanciamos objetos de la subclase
$g1 = new ElectricGuitar("Player II Stratocaster", "Fender", 800, false);
$g2 = new ElectricGuitar("Flying V", "Jackson", 17800, true);

// Demostramos el uso de la INTERFAZ (Vendible) antes de agregar al inventario
echo $g1->aplicarDescuento(10) ; // Aplicamos 10% de descuento a la Fender

$miInventario->add($g1);
$miInventario->add($g2);

// Demostramos Polimorfismo llamando al método común
$miInventario->showModel("Fender");

?>

