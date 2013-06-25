<?php

namespace ApplicationTest\Model;

use Application\Model\Node;
use PHPUnit_Framework_TestCase;

class NodeTest extends PHPUnit_Framework_TestCase
{
    public function testNodeInitialState()
    {
        $Node = new Node();

        $this->assertNull($Node->id, '"id" should initially be null');
        $this->assertNull($Node->nodename, '"nodename" should initially be null');
        $this->assertNull($Node->ipaddr, '"ipaddr" should initially be null');
        $this->assertNull($Node->description, '"description" should initially be null');
        $this->assertNull($Node->lastseen, '"lastseen" should initially be null');
    }

    public function testExchangeArraySetsPropertiesCorrectly()
    {
        $Node = new Node();
        $data  = array(
            'id'     => 123,
            'nodename'  => 'some nodename',
            'ipaddr' => 'some ipaddr',
            'lastseen' => 'some lastseen',
            'description' => 'some description',
        );

        $Node->exchangeArray($data);

        $this->assertSame($data['id'], $Node->id, '"id" was not set correctly');
        $this->assertSame($data['nodename'], $Node->nodename, '"nodename" was not set correctly');
        $this->assertSame($data['ipaddr'], $Node->ipaddr, '"ipaddr" was not set correctly');
        $this->assertSame($data['lastseen'], $Node->lastseen, '"lastseen" was not set correctly');
        $this->assertSame($data['description'], $Node->description, '"description" was not set correctly');
    }

    public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent()
    {
        $Node = new Node();

        $Node->exchangeArray(
            array(
                'id'     => 123,
                'nodename'  => 'some nodename',
                'ipaddr' => 'some ipaddr',
                'lastseen' => 'some lastseen',
                'description' => 'some description',
            )
        );
        $Node->exchangeArray(array());

        $this->assertNull($Node->id, '"id" should initially be null');
        $this->assertNull($Node->nodename, '"nodename" should initially be null');
        $this->assertNull($Node->ipaddr, '"ipaddr" should initially be null');
        $this->assertNull($Node->description, '"description" should initially be null');
        $this->assertNull($Node->lastseen, '"lastseen" should initially be null');
    }
}