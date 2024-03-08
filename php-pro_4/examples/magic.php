<?php

class SomeClass{

    protected string $name;
    protected array $vars = [
        'a' => '1',
        'b' => '2'
    ];
    protected DateTime $date;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->date = new DateTime();
    }

    public function sayHello():void{
        echo 'Hello' . PHP_EOL;
    }

    public function seyHelloUser():void{
        echo 'Hello ' . $this->name . PHP_EOL;
    }


    public function __call(string $method, array $args):mixed{
        $methods =[
            'sey' => 'seyHello',
            'sey2' => 'sayHelloUser'
        ];
        if (!isset($methods[$method])){
            throw new Error('Method not found'. PHP_EOL);
        }
        $currentMethod = $methods[$method];
        return $this->$currentMethod($args);
    }

    public function __get(string $var){
        if (!isset($this->vars[$var])){
            throw new Error('Argument not found' . PHP_EOL);
        }
        return $this->vars[$var];
    }

    public function __set(string $var, mixed $value):void{
        $this->vars[$var] = $value;
    }

    public function __serialize():array{
        return [
            'vars' => $this->vars,
            'date' => $this->date->format('d.m.Y H:i:s'),
            'name' => $this->name
        ];
    }

    public function __unserialize(array $data): void{
        $this->date = new DateTime($data['date']);
    }

//    public function __isset(string $name): bool{
//
//    }

    public function __destruct()
    {
//        echo 'Object is removed' . PHP_EOL;
    }
}
$o = new SomeClass('Pretro');
//$o->seyHelloUser();
//$o->qq =567;
//echo $o->qq . PHP_EOL;
//$s = serialize($o);
//$o2 = unserialize($s);

