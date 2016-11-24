<?php

use Ganjaaa\TinyCounter;
use PHPUnit\Framework\TestCase;

class TinyCounterTest extends TestCase {

    public function testInstall() {
        if(is_file(__DIR__.'/testcounter.db')){
            unlink(__DIR__.'/testcounter.db');
        } 
        eval('class TinyTestCounter extends Ganjaaa\TinyCounter { static $dbFile = __DIR__ . \'/testcounter.db\'; }');
        $rslt = TinyTestCounter::_install();
        $this->assertNotEquals(false, $rslt);
        if(is_file(__DIR__.'/testcounter.db')){
            unlink(__DIR__.'/testcounter.db');
        }
    }

    /**
     * @depends testInstall
     */
    public function testGet() {
        if(is_file(__DIR__.'/testcounter.db')){
            unlink(__DIR__.'/testcounter.db');
        } 

        $rslt = TinyTestCounter::_install();
        
        for ($i = 0; $i >= 10; $i++) {
            $rslt = TinyTestCounter::get('UnitTest'.$i);
            $this->assertEquals(0, $rslt);
        }
        
        if(is_file(__DIR__.'/testcounter.db')){
            unlink(__DIR__.'/testcounter.db');
        }
    }

    /**
     * @depends testGet
     */
    public function testSet() {
        if(is_file(__DIR__.'/testcounter.db')){
            unlink(__DIR__.'/testcounter.db');
        } 

        $rslt = TinyTestCounter::_install();
        
        for ($i = 99; $i >= 0; $i--) {
            $rslt = TinyTestCounter::set('UnitTest', $i);
            $this->assertEquals($i, $rslt);
        }
        
        if(is_file(__DIR__.'/testcounter.db')){
            unlink(__DIR__.'/testcounter.db');
        }
    }

    /**
     * @depends testSet
     */
    public function testInc() {
        if(is_file(__DIR__.'/testcounter.db')){
            unlink(__DIR__.'/testcounter.db');
        } 

        $rslt = TinyTestCounter::_install();
        
        $rslt = TinyTestCounter::set('UnitTest', 0);

        for ($i = 1; $i < 50; $i++) {
            $rslt = TinyTestCounter::inc('UnitTest');
            $this->assertEquals($i, $rslt);
        }
        
        if(is_file(__DIR__.'/testcounter.db')){
            unlink(__DIR__.'/testcounter.db');
        }
    }

    /**
     * @depends testSet
     */
    public function testDec() {
        if(is_file(__DIR__.'/testcounter.db')){
            unlink(__DIR__.'/testcounter.db');
        } 

        $rslt = TinyTestCounter::_install();
        
        $rslt = TinyTestCounter::set('UnitTest', 66);

        for ($i = 1; $i < 50; $i++) {
            $rslt = TinyTestCounter::dec('UnitTest');
            $this->assertEquals(66 - $i, $rslt);
        }
        
        if(is_file(__DIR__.'/testcounter.db')){
            unlink(__DIR__.'/testcounter.db');
        }
    }

}
