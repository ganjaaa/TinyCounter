<?php

use Ganjaaa\TinyCounter;
use PHPUnit\Framework\TestCase;

class TinyCounterTest extends TestCase {

    public function testInstall() {
        eval('class TinyTestCounter extends TinyCounter { static $dbFile = __DIR__ . \'/testcounter.db\'; }');
        $rslt = TinyTestCounter::_install();
        $this->assertEquals(true, $rslt);
    }

    /**
     * @depends testInstall
     */
    public function testGet() {
        for ($i = 0; $i >= 10; $i++) {
            $rslt = TinyCounter::get('UnitTest'.$i);
            $this->assertEquals(0, $rslt);
        }
    }

    /**
     * @depends testGet
     */
    public function testSet() {
        for ($i = 99; $i >= 0; $i--) {
            $rslt = TinyCounter::set('UnitTest', $i);
            $this->assertEquals($i, $rslt);
        }
    }

    /**
     * @depends testSet
     */
    public function testInc() {
        $rslt = TinyCounter::set('UnitTest', 0);

        for ($i = 1; $i < 50; $i++) {
            $rslt = TinyCounter::inc('UnitTest');
            $this->assertEquals($i, $rslt);
        }
    }

    /**
     * @depends testSet
     */
    public function testDec() {
        $rslt = TinyCounter::set('UnitTest', 66);

        for ($i = 1; $i < 50; $i++) {
            $rslt = TinyCounter::dec('UnitTest');
            $this->assertEquals(66 - $i, $rslt);
        }
    }

}
