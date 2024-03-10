<?php
class SubObject
{    static $instances = 0;
    public $instance;
    public DateTime $date;

    public function __construct() {
        $this->instance = ++self::$instances;
        $this->date = new DateTime();
    }
    public function __clone() {
        $this->instance = ++self::$instances;
    }
}
class MyCloneable
{    public $object1;
//    public  DateTime $date;
    public $object2;
    function __clone()
    {
        // Принудительно клонируем this->object1, иначе
        // он будет указывать на один и тот же объект.
        $this->object1 = clone $this->object1;
        $this->object1->date = clone $this->object1->date;
    }
}
$obj = new MyCloneable();
$obj->object1 = new SubObject();
$obj->object2 = new SubObject();
$obj2 = clone $obj;
$obj2->object2->date->modify('+1YEAR');
$obj2->object1->date->modify('+12YEAR');
exit;