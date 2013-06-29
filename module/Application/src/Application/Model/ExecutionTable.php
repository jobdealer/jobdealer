<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class ExecutionTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getExecution($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function getAllExecutionForNode($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('nodeid' => $id));
        if (!$rowset) {
            throw new \Exception("Could not find Execution with nodeid $id");
        }
        return $rowset;
    }

    public function saveExecution(Execution $execution)
    {
        $data = array(
            'node' => $execution->nodeid,
            'job'  => $execution->jobid,
            'schedule' => $execution->schedule,
            'description' => $execution->description,
        );

        $id = (int)$execution->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getExecution($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteExecution($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}