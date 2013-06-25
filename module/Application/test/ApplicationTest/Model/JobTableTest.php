<?php
namespace JobTest\Model;

use Application\Model\JobTable;
use Application\Model\Job;
use Zend\Db\ResultSet\ResultSet;
use PHPUnit_Framework_TestCase;

class JobTableTest extends PHPUnit_Framework_TestCase
{
    public function testFetchAllReturnsAllJobs()
    {
        $resultSet        = new ResultSet();
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
            array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
            ->method('select')
            ->with()
            ->will($this->returnValue($resultSet));

        $JobTable = new JobTable($mockTableGateway);

        $this->assertSame($resultSet, $JobTable->fetchAll());
    }
    
    public function testCanRetrieveAnJobByItsId()
    {
        $job = new Job();
        $job->exchangeArray(
            array(
                'id'     => 123,
                'description' => 'some description',
                'action'  => 'some action',
                'defaultschedule' => 'some default schedule',
                'estimatedduration' => 'some estimated duration',
            )
        );

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Job());
        $resultSet->initialize(array($job));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
            ->method('select')
            ->with(array('id' => 123))
            ->will($this->returnValue($resultSet));

        $jobTable = new JobTable($mockTableGateway);

        $this->assertSame($job, $jobTable->getJob(123));
    }

    public function testCanDeleteAnJobByItsId()
    {
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('delete'), array(), '', false);
        $mockTableGateway->expects($this->once())
            ->method('delete')
            ->with(array('id' => 123));

        $jobTable = new JobTable($mockTableGateway);
        $jobTable->deleteJob(123);
    }

    public function testSaveJobWillInsertNewJobsIfTheyDontAlreadyHaveAnId()
    {
        $jobData = array(
            'description' => 'some description',
            'action'  => 'some action',
            'defaultschedule' => 'some default schedule',
            'estimatedduration' => 'some estimated duration',
        );
        $job     = new Job();
        $job->exchangeArray($jobData);

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('insert'), array(), '', false);
        $mockTableGateway->expects($this->once())
            ->method('insert')
            ->with($jobData);

        $jobTable = new JobTable($mockTableGateway);
        $jobTable->saveJob($job);
    }

    public function testSaveJobWillUpdateExistingJobsIfTheyAlreadyHaveAnId()
    {
        $jobData = array(
            'id'     => 123,
            'description' => 'some description',
            'action'  => 'some action',
            'defaultschedule' => 'some default schedule',
            'estimatedduration' => 'some estimated duration',
        );
        $job     = new Job();
        $job->exchangeArray($jobData);

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Job());
        $resultSet->initialize(array($job));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
            array('select', 'update'), array(), '', false);
        $mockTableGateway->expects($this->once())
            ->method('select')
            ->with(array('id' => 123))
            ->will($this->returnValue($resultSet));
        $mockTableGateway->expects($this->once())
            ->method('update')
            ->with(array(
                    'description' => 'some description',
                    'action'  => 'some action',
                    'defaultschedule' => 'some default schedule',
                    'estimatedduration' => 'some estimated duration',
                ),
                array('id' => 123)
            );

        $jobTable = new JobTable($mockTableGateway);
        $jobTable->saveJob($job);
    }

    public function testExceptionIsThrownWhenGettingNonexistentJob()
    {
        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Job());
        $resultSet->initialize(array());

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
            ->method('select')
            ->with(array('id' => 123))
            ->will($this->returnValue($resultSet));

        $jobTable = new JobTable($mockTableGateway);

        try
        {
            $jobTable->getJob(123);
        }
        catch (\Exception $e)
        {
            $this->assertSame('Could not find row 123', $e->getMessage());
            return;
        }

        $this->fail('Expected exception was not thrown');
    }
}