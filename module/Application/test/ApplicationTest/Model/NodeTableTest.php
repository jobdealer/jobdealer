<?php
namespace NodeTest\Model;

use Application\Model\NodeTable;
use Application\Model\Node;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Predicate\Expression;
use PHPUnit_Framework_TestCase;

class NodeTableTest extends PHPUnit_Framework_TestCase
{
    public function testFetchAllReturnsAllNodes()
    {
        $resultSet        = new ResultSet();
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
            array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
            ->method('select')
            ->with()
            ->will($this->returnValue($resultSet));

        $NodeTable = new NodeTable($mockTableGateway);

        $this->assertSame($resultSet, $NodeTable->fetchAll());
    }
    public function testCanRetrieveAnNodeByItsId()
    {
        $node = new Node();
        $node->exchangeArray(
            array(
                'id'     => 123,
                'nodename'  => 'some nodename',
                'ipaddr' => 'some ipaddr',
                'lastseen' => 'some lastseen',
                'description' => 'some description',            )
        );

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Node());
        $resultSet->initialize(array($node));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
            ->method('select')
            ->with(array('id' => 123))
            ->will($this->returnValue($resultSet));

        $nodeTable = new NodeTable($mockTableGateway);

        $this->assertSame($node, $nodeTable->getNode(123));
    }

    public function testCanDeleteAnNodeByItsId()
    {
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('delete'), array(), '', false);
        $mockTableGateway->expects($this->once())
            ->method('delete')
            ->with(array('id' => 123));

        $nodeTable = new NodeTable($mockTableGateway);
        $nodeTable->deleteNode(123);
    }

    public function testSaveNodeWillInsertNewNodesIfTheyDontAlreadyHaveAnId()
    {
        $nodeData = array(
            'nodename'  => 'some nodename',
            'ipaddr' => 'some ipaddr',
            'lastseen' => 'some lastseen',
            'description' => 'some description',
        );
        $node     = new Node();
        $node->exchangeArray($nodeData);

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('insert'), array(), '', false);
        $mockTableGateway->expects($this->once())
            ->method('insert')
            ->with($nodeData);

        $nodeTable = new NodeTable($mockTableGateway);
        $nodeTable->saveNode($node);
    }

    public function testSaveNodeWillUpdateExistingNodesIfTheyAlreadyHaveAnId()
    {
        $nodeData = array(
            'id'     => 123,
            'nodename'  => 'some nodename',
            'ipaddr' => 'some ipaddr',
            'lastseen' => 'some lastseen',
            'description' => 'some description',
        );
        $node     = new Node();
        $node->exchangeArray($nodeData);

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Node());
        $resultSet->initialize(array($node));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
            array('select', 'update'), array(), '', false);
        $mockTableGateway->expects($this->once())
            ->method('select')
            ->with(array('id' => 123))
            ->will($this->returnValue($resultSet));
        $mockTableGateway->expects($this->once())
            ->method('update')
            ->with(array(
                    'nodename'  => 'some nodename',
                    'ipaddr' => 'some ipaddr',
                    'lastseen' => 'some lastseen',
                    'description' => 'some description',
                ),
                array('id' => 123)
            );

        $nodeTable = new NodeTable($mockTableGateway);
        $nodeTable->saveNode($node);
    }

    public function testExceptionIsThrownWhenGettingNonexistentNode()
    {
        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Node());
        $resultSet->initialize(array());

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
            ->method('select')
            ->with(array('id' => 123))
            ->will($this->returnValue($resultSet));

        $nodeTable = new NodeTable($mockTableGateway);

        try
        {
            $nodeTable->getNode(123);
        }
        catch (\Exception $e)
        {
            $this->assertSame('Could not find row 123', $e->getMessage());
            return;
        }

        $this->fail('Expected exception was not thrown');
    }
}