<?php

interface ICalculator
{
    public function __construct(array $arrNumbers);

    public function doWithNumbers():void;
}

abstract class ACalculator implements ICalculator{
    public function __construct(protected array $arrNumbers){
        ArrNumbersValidator::arrNumbersValid($this->arrNumbers);
        $this->doWithNumbers();
    }
    public function doWithNumbers(): void
    {
        // TODO: Implement doWithNumbers() method.
    }

}


class SumNumber extends ACalculator
{
    public function doWithNumbers():void{
      echo 'Сумма чисел = ' . array_sum($this->arrNumbers) .  PHP_EOL;
    }
}

//class SubtractingNumber extends ACalculator
//{
//    public function doWithNumbers():void{
//        $res= $this->arrNumbers[0];
//        for ($i=1; $i < array_count_values($this->arrNumbers); $i++){
//            $res -= $this->arrNumbers[$i];
//        }
//       echo 'Вычитание чисел = ' . $res . PHP_EOL;
//    }
//}
//
class DividingNumber extends ACalculator
{
    public function doWithNumbers():void{
        ArrNumbersValidator::valueInArrIsNull($this->arrNumbers);
        foreach ()
    }
}

class MultiplyingNumber extends ACalculator
{
    public function doWithNumbers():void{
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
//$SubtractingNumber = new SubtractingNumber([100,10]);

$MultiplyingNumbers = new MultiplyingNumber([10,5]);
