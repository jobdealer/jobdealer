<?php
namespace Application\Model;

use Zend\Form\Annotation as Form;

class Execution
{
    public $id;
    public $nodeid;// Node Object
    public $jobid; // Job Object
    public $schedule; //Overloaded the default one set in job object
    public $description; //Overloaded the job description if needed
    
    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->nodeid = (isset($data['nodeid'])) ? $data['nodeid'] : null;
        $this->jobid  = (isset($data['jobid'])) ? $data['jobid'] : null;
        $this->schedule  = (isset($data['schedule'])) ? $data['schedule'] : null;
        $this->description  = (isset($data['description'])) ? $data['description'] : null;
    }

}