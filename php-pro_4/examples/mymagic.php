<?php

class MagicFunction
{
    protected string $name;
    protected string $surname;
    protected string $age;
    protected array $vars_class =[];

    public function __construct(string $name, string $age){
        $this->name = $name;
        $this->age = $age;
        $this->vars_class[] = $name;
        $this->vars_class[] = $age;
    }

    public function __set(string $name, mixed $value){
        //valid
        $this->$name = $value;
        $this->vars_class[] = $name;
    }

    public function __get(string $name){
        return $this->$name;
    }

    public function __isset(string $fild): bool{
        return isset($this->$fild);
    }

    public function __toString():string{
        return $this->name . ' ' . $this->surname . ' ' . $this->age . PHP_EOL;
    }

    public function __invoke(...$values){
       var_dump($values);
    }

    public static function __set_state(array $propertis): object {

    }


}

class MyClone
{
    public object $obj;

    public function __clone(){
        $this->obj = clone $this->obj;
    }
}


$magic = new MagicFunction('Grisha', '38');
echo $magic->name . PHP_EOL; // __get
$magic->surname = 'Smith'; //__set
echo (isset($magic->age)) . PHP_EOL; //__isset(true)
echo (isset($magic->year)) . PHP_EOL; // __isset (falce) (не понимаю для чего он нужен)
echo $magic; //toString (class fields are displayed as a string)
$magic('Kiev'); //__invoke (like function)
var_dump(is_callable($magic)); //__invoke (like function);

// метод __set_state  вообще не понятно  для чего он нужен и как он реализуется тригером для него является var_export
//  а  какой масив свойст и откудао н берется не понятно.
$clone = new MyClone();
$clone = clone $magic;
echo $clone->name . PHP_EOL;
echo$magic->name . PHP_EOL;
$clone->name = 'Evgeniy';
echo $clone->name . PHP_EOL;
echo$magic->name . PHP_EOL;

