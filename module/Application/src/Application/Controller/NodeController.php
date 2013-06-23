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

class NodeController extends AbstractActionController
{
    protected $nodeTable;

    public function indexAction()
    {
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

    private function getNodeTable()
    {
        if (!$this->nodeTable) {
            $sm = $this->getServiceLocator();
            $this->nodeTable = $sm->get('Application\Model\NodeTable');
        }
        return $this->nodeTable;
    }
}
