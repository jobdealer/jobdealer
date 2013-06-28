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
use Application\Model\Job;

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
    private function getJobTable()
    {
        if (!$this->jobTable) {
            $sm = $this->getServiceLocator();
            $this->jobTable = $sm->get('Application\Model\JobTable');
        }
        return $this->jobTable;
    }
    public function addAction(){
        $builder = new AnnotationBuilder();
        $form = $builder->createForm(new Job());
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
            $job = new Job();
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $job->exchangeArray($form->getData());
                try {
                    $this->getJobTable()->saveJob($job);
                } catch (\Exception $e) {
                    $pdoException = $e->getPrevious();
                    var_dump($pdoException);
                }


                // Redirect to list of job
                return $this->redirect()->toRoute('job');
            }
        }
        #$form->setAttribute('action', $this->url('job', array('action' => 'add')));

        return array('form' => $form);
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('job');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getJobTable()->deleteJob($id);
            }

            // Redirect to list of jobs
            return $this->redirect()->toRoute('job');
        }

        return array(
            'id'    => $id,
            'job' => $this->getJobTable()->getJob($id)
        );
    }
}
