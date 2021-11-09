<?php
use PHPUnit\Framework\TestCase;
use AndyN9\Contribution401kLibrary\Contribution401k;

class Contribution401kTest extends TestCase {
  protected $contribution401k;

  protected function setUp(): void {
    $this->contribution401k = new Contribution401k();
  }

  public function testGreet() {
    $this->expectOutputString('hello');
    $this->contribution401k->greet();
  }

}
