<?php
/**
 * Created by PhpStorm.
 * User: davidlopez
 * Date: 6/14/19
 * Time: 2:14 AM
 */

namespace App\MoneyChange;

use App\MoneyChange;
use PHPUnit\Framework\TestCase;

class MoneyChangeTest extends TestCase
{

    public function testValidatePay()
    {
        $change = new MoneyChange();
        $result = $change->validate_pay(1, 1);
        $this->assertNotTrue($result);

        $result = $change->validate_pay(2, 1);
        $this->assertNotTrue($result);

        $result = $change->validate_pay(2, 3);
        $this->assertTrue($result);

    }

    public function testValidateInput()
    {
        $change = new MoneyChange();
        $result = $change->validate_input(-1.00);
        $this->assertNotTrue($result);

        $result = $change->validate_input(0.00);
        $this->assertNotTrue($result);

        $result = $change->validate_input(0.01);
        $this->assertTrue($result);
    }

    public function testGetChange()
    {
        $change = new MoneyChange();
        $result = $change->getChange(2.50, 5);
        $this->assertEquals(2.50, $result['change']);

        $result = $change->getChange(1.25, 5);
        $this->assertEquals(3.75, $result['change']);

        $result = $change->getChange(2.50, 10);
        $this->assertEquals(7.50, $result['change']);
    }
}