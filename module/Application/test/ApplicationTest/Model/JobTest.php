<?php

namespace ApplicationTest\Model;

use Application\Model\Job;
use PHPUnit_Framework_TestCase;

class JobTest extends PHPUnit_Framework_TestCase
{
    public function testJobInitialState()
    {
        $Job = new Job();

        $this->assertNull($Job->id, '"id" should initially be null');
        $this->assertNull($Job->description, '"description" should initially be null');
        $this->assertNull($Job->action, '"action" should initially be null');
        $this->assertNull($Job->defaultschedule, '"defaultschedule" should initially be null');
        $this->assertNull($Job->estimatedduration, '"estimatedduration" should initially be null');
    }

    public function testExchangeArraySetsPropertiesCorrectly()
    {
        $Job = new Job();
        $data  = array(
            'id'     => 123,
            'description' => 'some description',
            'action'  => 'some action',
            'defaultschedule' => 'some default schedule',
            'estimatedduration' => 'some estimated duration',
        );

        $Job->exchangeArray($data);

        $this->assertSame($data['id'], $Job->id, '"id" was not set correctly');
        $this->assertSame($data['description'], $Job->description, '"description" was not set correctly');
        $this->assertSame($data['action'], $Job->action, '"action" was not set correctly');
        $this->assertSame($data['defaultschedule'], $Job->defaultschedule, '"defaultschedule" was not set correctly');
        $this->assertSame($data['estimatedduration'], $Job->estimatedduration, '"estimatedduration" was not set correctly');
    }

    public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent()
    {
        $Job = new Job();

        $Job->exchangeArray(
            array(
                'id'     => 123,
                'description' => 'some description',
                'action'  => 'some action',
                'defaultschedule' => 'some default schedule',
                'estimatedduration' => 'some estimated duration',
            )
        );
        $Job->exchangeArray(array());

        $this->assertNull($Job->id, '"id" should initially be null');
        $this->assertNull($Job->description, '"description" should initially be null');
        $this->assertNull($Job->action, '"action" should initially be null');
        $this->assertNull($Job->defaultschedule, '"defaultschedule" should initially be null');
        $this->assertNull($Job->estimatedduration, '"estimatedduration" should initially be null');
    }
}