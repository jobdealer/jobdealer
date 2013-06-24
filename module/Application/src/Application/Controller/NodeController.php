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

class NodeController extends AbstractActionController
{
    protected $nodeTable;

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
        #$form->setAttribute('action', $this->url('node', array('action' => 'add')));

        return array('form' => $form);
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

    private function getNodeTable()
    {
        if (!$this->nodeTable) {
            $sm = $this->getServiceLocator();
            $this->nodeTable = $sm->get('Application\Model\NodeTable');
        }
        return $this->nodeTable;
    }
}
