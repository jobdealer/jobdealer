<?php
namespace Application\Model;

//use Zend\Db\Sql\Predicate\Expression;
use Zend\Db\TableGateway\TableGateway;

class NodeTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        /*$select = $this->tableGateway
            ->getSql()
            ->select()
            ->columns(
                array(
                    '*' => '*' ,
                    'ipaddr' => new Expression('INET_NTOA(ipaddr)'),
                )
            );
        $resultSet = $this->tableGateway->selectWith($select);*/
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }
    public function getNodeIdFromIpaddr ($ipaddr)
    {
        $rowset = $this->tableGateway->select(array('ipaddr' => $ipaddr));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find node with ipaddr $ipaddr");
        }
        return $row->id;

    }
    public function getNode($id)
    {
        $id  = (int) $id;
        //$select = $this->tableGateway
        //    ->getSql()
        //    ->select()
        //    ->columns(
        //        array(
        //            '*' => '*' ,
        //            'ipaddr' => new Expression('INET_NTOA(ipaddr)'),
        //        )
        //    )->where(array('id' => $id));
        //
        //$rowset = $this->tableGateway->selectWith($select);
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveNode(Node $Node)
    {
        $data = array(
            'nodename' => $Node->nodename,
            //'ipaddr'  => new Expression('INET_ATON(\'' . $Node->ipaddr . '\')'),
            'ipaddr'  => $Node->ipaddr,
            'description' => $Node->description,
            'lastseen' => $Node->lastseen,
        );

        $id = (int)$Node->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getNode($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteNode($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}