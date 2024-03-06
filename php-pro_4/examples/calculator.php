<?php

interface ICalculator
{
    public function __construct(array $arrNumbers);

    public function actionWithNumbers():void;
}

abstract class ACalculator implements ICalculator{
    public function __construct(protected array $arrNumbers){
        ArrNumbersValidator::arrNumbersValid($this->arrNumbers);
        $this->actionWithNumbers();
    }
    public function actionWithNumbers(): void
    {
        // TODO: Implement doWithNumbers() method.
    }

}


class SumNumber extends ACalculator
{
    public function actionWithNumbers():void{
      echo 'Сумма чисел = ' . array_sum($this->arrNumbers) .  PHP_EOL;
    }
}

class SubtractingNumber extends ACalculator
{
    public function actionWithNumbers():void{
        $res= null;
        foreach ($this->arrNumbers as $value){
            $res == null ? $res = $value : $res -=$value;
        }
       echo 'Вычитание чисел = ' . $res . PHP_EOL;
    }
}

class DividingNumber extends ACalculator
{
    public function actionWithNumbers():void{
        ArrNumbersValidator::valueInArrIsNull($this->arrNumbers);
        $res =null;
        foreach ($this->arrNumbers as $value){
            $res === null ? $res = $value : $res/=$value;
        }
        echo 'Деление чисел = ' . $res . PHP_EOL;
    }
}

class MultiplyingNumber extends ACalculator
{
    public function actionWithNumbers():void{
        echo 'Произведение чисел = ' . array_product($this->arrNumbers)  . PHP_EOL;
    }
}

class ArrNumbersValidator
{
    static function arrNumbersValid(array $arrNumbers): void{
        foreach ($arrNumbers as $arrNumber){
            if (!(is_int($arrNumber) or is_float($arrNumber))){
                throw new InvalidArgumentException('Value ' . $arrNumber . ' is not number');
            }
        }
    }
    static function valueInArrIsNull(array $arrNumbers):void{
        foreach ( $arrNumbers as  $value) {
            if ($value === 0){
                throw new InvalidArgumentException('When dividing numbers, the value cannot be equal to Zero');
            }
        }
    }
}


$sumNumbers = new SumNumber([40, 50, 77.9, 55]);
$divNumber = new DividingNumber([60, 20, 6]);
$SubtractingNumber = new SubtractingNumber([100, 10]);
$MultiplyingNumbers = new MultiplyingNumber([10, 0]);
