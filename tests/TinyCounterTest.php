<?php

use Ganjaaa\TinyCounter;
use PHPUnit\Framework\TestCase;
 
class TinyCounterTest extends TestCase {
 
    public function testInstall(){
        eval('class TinyTestCounter extends TinyCounter { static $dbFile = __DIR__ . \'/testcounter.db\'; }')
        $rslt = TinyTestCounter::_install();
        $this->assertEquals(true, $rslt);
    }
    
    /**
     * @depends testInstall
     */
    public function testGet(){
        
    }
    
    /**
     * @depends testGet
     */
    public function testSet(){
        
    }
    
    /**
     * @depends testSet
     */
    public function testInc(){
        
    }
    
    /**
     * @depends testInc
     */
    public function testDec(){
        
    }
}
