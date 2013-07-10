<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Api\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;

use Application\Model\Node;
use Application\Model\Job;
use Application\Model\Execution;
use Zend\View\Model\JsonModel;


class ApiController extends AbstractRestfulController
{
    protected $nodeTable;
    protected $jobTable;
    protected $executionTable;

    public function getList()
    {
        $result = new JsonModel(array('list' => 'success'));
        return $result;
    }

    public function get($action)
    {
        switch($action) {
            case 'getConfig':
                $aExecutionJob = array();
                $iNodeId = $this->getNodeTable()->getNodeIdFromIpaddr($_SERVER['REMOTE_ADDR']);

                $aExecutionTable = $this->getExecutionTable()->getAllExecutionForNode($iNodeId);
                foreach ($aExecutionTable as $oExecutionTable) {
                    $aExecutionJob[] = $this->getJobTable()->getJob($oExecutionTable->jobid);
                }
                $result = new JsonModel(array('get' => 'success', 'action' => $aExecutionJob));
                break;
            default:
                throw new \Exception("Action $action doesn't exist");
        }
        $result->setTerminal(true);
        return $result;
    }

    public function create($data)
    {
        $result = new JsonModel(array('create' => "success", "data" => $data));
        $result->setTerminal(true);
        return $result;
    }

    public function update($id, $data)
    {
        $result = new JsonModel(array('update' => "success", 'data' => $data, 'id' => $id));
        $result->setTerminal(true);
        return $result;
    }

    public function delete($id)
    {
        $result = new JsonModel(array('remove' => 'success', 'id' => $id, "who" => $_SERVER['REMOTE_ADDR']));
        $result->setTerminal(true);
        return $result;
    }

    private function getNodeTable()
    {
        if (!$this->nodeTable) {
            $sm = $this->getServiceLocator();
            $this->nodeTable = $sm->get('Application\Model\NodeTable');
        }
        return $this->nodeTable;
    }

    private function getExecutionTable()
    {
        if (!$this->executionTable) {
            $sm = $this->getServiceLocator();
            $this->executionTable = $sm->get('Application\Model\ExecutionTable');
        }
        return $this->executionTable;
    }

    private function getJobTable()
    {
        if (!$this->jobTable) {
            $sm = $this->getServiceLocator();
            $this->jobTable = $sm->get('Application\Model\JobTable');
        }
        return $this->jobTable;
    }

}