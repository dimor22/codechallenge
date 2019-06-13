<?php
/**
 * Created by PhpStorm.
 * User: davidlopez
 * Date: 6/11/19
 * Time: 11:24 PM
 */

namespace App;

class MoneyChange
{

    /**
     * @var double
     */
    protected $cost;

    /**
     * @var double
     */
    protected $paid;

    /**
     * @var array
     */
    protected $cents = [2000,1000,500,200,100,25,10,5,1];

    /**
     * @var int
     */
    protected $change = 0;

    /**
     * @var array
     */
    protected $changeOutput = [];


    /**
     * @param float $cost
     * @param float $paid
     * @return array
     */
    public function getChange(float $cost, float $paid): array
    {
        $this->validate_input($cost);
        $this->validate_input($paid);

        $this->cost = $this->convert_to_cents($cost);
        $this->paid = $this->convert_to_cents($paid);

        if ( !$this->validate_pay($this->cost, $this->paid) ){
            $this->change = 0;
        } else {
            $this->change = $this->paid - $this->cost;
            $this->changeOutput = $this->break_down_change($this->change);
        }

        $result = [
            'cost'      => sprintf("%.2f",$this->cost/100),
            'paid'      => sprintf("%.2f",$this->paid/100),
            'change'    => sprintf("%.2f",$this->change/100),
            'breakdown' => $this->changeOutput
        ];

        return $result;
    }

    /**
     * @param float $number
     * @throws \Exception
     */
    public function validate_input(float $number)
    {
        if ( $number < 0.01 ){
            throw new \Exception('Paid amount must be greater than 0');
        }
    }

    /**
     * @param float $number
     * @return int
     */
    public function convert_to_cents(float $number) : int
    {
        return $number * 100;
    }

    /**
     * @param $cost
     * @param $pay
     * @return bool
     */
    public function validate_pay($cost, $pay)
    {
        if ( ($cost == $pay) || ($pay < $cost) ) {
            return false;
        }

        return true;
    }

    /**
     * @param $change
     * @return array
     */
    public function break_down_change($change){

        $changeOutput = [];

        foreach( $this->cents as $cents) {

            $name = $cents > 100 ? 'dollar bill' : 'cent coin';

            if ($cents == $change){
                $changeOutput[] = ["units" => 1 . " x ", "value" => "$" . sprintf("%.2f", $cents/100)  . " " . $name];
                $change -= $cents;
            } elseif ($cents < $change) {
                $changeOutput[] = ["units" => intval($change / $cents) . " x ", "value" => "$" . sprintf("%.2f",$cents/100)  . " " . $name];
                $change -= intval($change / $cents) * $cents;
            }
        }
        return $changeOutput;
    }

}