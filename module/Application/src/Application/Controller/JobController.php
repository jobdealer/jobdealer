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

class JobController extends AbstractActionController
{
    protected $jobTable;

    public function indexAction()
    {
        $this->getServiceLocator()
            ->get('viewhelpermanager')
            ->get('HeadLink')
            ->appendStylesheet('/css/famfamfam.css');

        try {
            return new ViewModel(array(
                'jobs' => $this->getJobTable()->fetchAll(),
            ));
        } catch (\Exception $e) {
            $pdoException = $e->getPrevious();
            var_dump($pdoException);
        }

    }
    public function getJobTable()
    {
        if (!$this->jobTable) {
            $sm = $this->getServiceLocator();
            $this->jobTable = $sm->get('Application\Model\JobTable');
        }
        return $this->jobTable;
    }
}
