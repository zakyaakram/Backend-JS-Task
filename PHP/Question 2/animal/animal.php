<?php
class Mammal {
  public $name;
  public $toString;
  
  public function __construct($name, $toString) {
    $this->name = $name;
    $this->toString = $toString;
  }
  public function toString() {
    return $this->toString;
  }
}
class Cat extends Mammal {
  public function greet() {
    echo "Meow";
  }
  public function toString() {
    return "cat name " . $this->name;
  }
}
class Dog extends Mammal {
  public function greet() {
    echo "Woof";
  }
  public function toString() {
    return " dog name  " . $this->name;
  }
}
$mammal = new Mammal("Ma", );
$cat = new Cat("C");
$dog = new Dog("D");

echo $mammal->toString() . 
echo $cat->toString() . 
echo $dog->toString() .