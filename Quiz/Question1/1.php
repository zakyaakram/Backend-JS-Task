class Product {
    public $id;
    public $name;
    public $price;
    public static $no_of_products = 8;

    function __construct($id, $name, $price) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    function calc_total_price($quantity) {
        return $this->price * $quantity;
    }

    function display_info() {
        echo "Product ID: " . $this->id . "<br>";
        echo "Product Name: " . $this->name . "<br>";
        echo "Product Price: $" . number_format($this->price, 2) . "<br>";
    }
}