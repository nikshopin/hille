<?php
namespace App\examples;

class MagicFunction
{
    public string $name;
    public string $age;
    public \DateTime $date;
    public function __construct(string $name, string $age){
        $this->name = $name;
        $this->age = $age;
        $this->date = new \DateTime();
    }
    public function __clone(){
        $this->name= 'DIma';
    }
}
class MyClone
{
    public object $obj;
    function __clone(){
        $this->obj = clone $this->obj;
        $this->obj->date =  clone $this->obj->date;
    }
}

$magic = new MagicFunction('Grisha',  '38');
$clone =new MyClone();
$clone->obj =  $magic;
$clone2 =clone $clone;
$clone2->obj->date->modify('+1YEAR');

exit;
