<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Form\Annotation\AnnotationBuilder;
use Application\Model\Node;
use Application\Model\Execution;

class NodeController extends AbstractActionController
{
    protected $nodeTable;
    protected $executionTable;
    protected $jobTable;

    public function indexAction()
    {
        $this->getServiceLocator()
             ->get('viewhelpermanager')
             ->get('HeadLink')
             ->appendStylesheet('/css/famfamfam.css');

        try {
            return new ViewModel(array(
                'nodes' => $this->getNodeTable()->fetchAll(),
            ));
        } catch (\Exception $e) {
            $pdoException = $e->getPrevious();
            var_dump($pdoException);
        }
    }

    public function statusAction()
    {
        return new ViewModel();
    }

    public function addAction(){
        $builder = new AnnotationBuilder();
        $form = $builder->createForm(new Node());
        $form->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Add',
                'id' => 'submitbutton',
                'class' => 'btn btn-success',
            ),
        ));
        $request = $this->getRequest();
        if ($request->isPost()) {
            $node = new Node();
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $node->exchangeArray($form->getData());
                try {
                    $this->getNodeTable()->saveNode($node);
                } catch (\Exception $e) {
                    $pdoException = $e->getPrevious();
                    var_dump($pdoException);
                }


                // Redirect to list of node
                return $this->redirect()->toRoute('node');
            }
        }
        $form->setAttribute('action', $this->url()->fromRoute('node').'/add');

        return array('form' => $form);
    }

    public function editAction(){
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('node', array('action' => 'add'));
        }
        try {
            $node = $this->getNodeTable()->getNode($id);
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('node', array('action' => 'index'));
        }

        $builder = new AnnotationBuilder();
        $form = $builder->createForm(new Node());
        $form->bind($node);
        //$form->setAttribute('action', $this->url()->fromRoute('node').'/edit');
        $form->add(
            array(
                 'name' => 'submit',
                 'attributes' => array(
                     'type'  => 'submit',
                     'value' => 'Edit',
                     'id' => 'submitbutton',
                     'class' => 'btn btn-success',
                 ),
            )
        );

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                try {
                    $this->getNodeTable()->saveNode($node);
                    return $this->redirect()->toRoute('node');
                } catch (\Exception $e) {
                    $pdoException = $e->getPrevious();
                    var_dump($pdoException);
                }
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }


    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('node');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getNodeTable()->deleteNode($id);
            }

            // Redirect to list of nodes
            return $this->redirect()->toRoute('node');
        }

        return array(
            'id'    => $id,
            'node' => $this->getNodeTable()->getNode($id)
        );
    }

    public function linkAction() {
        $iNodeId = (int) $this->params()->fromRoute('id', 0);
        $iJobId = (int) $this->params()->fromRoute('job', 0);

        $oExecution = new Execution();
        $aExecution = array(
            "nodeid" => $iNodeId,
            "jobid" => $iJobId,
        );

        $oExecution->exchangeArray($aExecution);
        try {
            $this->getExecutionTable()->saveExecution($oExecution);
        } catch (\Exception $e) {
            $pdoException = $e->getPrevious();
            var_dump($pdoException);
        }
    }

    public function unlinkAction() {
        $iNodeId = (int) $this->params()->fromRoute('id', 0);
        $iExecutionId = (int) $this->params()->fromRoute('job', 0);
        $this->getExecutionTable()->deleteExecution($iExecutionId);

        // Redirect to node detail
        return $this->redirect()->toRoute('node', array('action' => 'view', 'id' => $iNodeId));
    }



    public function viewAction() {
        $this->getServiceLocator()
            ->get('viewhelpermanager')
            ->get('HeadLink')
            ->appendStylesheet('/css/famfamfam.css');

        $id = (int) $this->params()->fromRoute('id', 0);
        $oNodeTable = $this->getNodeTable()->getNode($id);

        $aJobs = $this->getJobTable()->fetchAll();

        $aExecutionTable = $this->getExecutionTable()->getAllExecutionForNode($id);
        $aExecution = array();
        foreach ($aExecutionTable as $oExecutionTable) {
            $oExecutionTable->job = $this->getJobTable()->getJob($oExecutionTable->jobid);
            $aExecution[] = $oExecutionTable;
        }
        return new ViewModel(
            array(
                'oNode' => $oNodeTable,
                'aExecution' => $aExecution,
                'aJobs' => $aJobs
            )
        );
    }

    private function getNodeTable()
    {
        if (!$this->nodeTable) {
            $sm = $this->getServiceLocator();
            $this->nodeTable = $sm->get('Application\Model\NodeTable');
        }
        return $this->nodeTable;
    }

    private function getJobTable()
    {
        if (!$this->jobTable) {
            $sm = $this->getServiceLocator();
            $this->jobTable = $sm->get('Application\Model\JobTable');
        }
        return $this->jobTable;
    }

    private function getExecutionTable()
    {
        if (!$this->executionTable) {
            $sm = $this->getServiceLocator();
            $this->executionTable = $sm->get('Application\Model\ExecutionTable');
        }
        return $this->executionTable;
    }
}
