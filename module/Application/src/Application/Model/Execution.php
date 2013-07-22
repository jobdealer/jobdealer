<?php
namespace Application\Model;

use Zend\Form\Annotation as Form;

class Execution
{
    /**
     * @Form\Required(false)
     * @Form\Attributes({"type":"hidden"})
     */
    public $id;
    /**
     * @Form\Required(false)
     * @Form\Attributes({"type":"int"})
     */
    public $nodeid;// Node Object
    /**
     * @Form\Required(false)
     * @Form\Attributes({"type":"int"})
     */
    public $jobid; // Job Object
    /**
     * @Form\Required(false)
     * @Form\Attributes({"type":"text"})
     * @Form\Options({"label":"Schedule"})
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Filter({"name":"StripTags"})
     */
    public $schedule; //Overloaded the default one set in job object
    /**
     * @Form\Required(false)
     * @Form\Attributes({"type":"text"})
     * @Form\Options({"label":"Description"})
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Filter({"name":"StripTags"})
     */
    public $description; //Overloaded the job description if needed
    
    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->nodeid = (isset($data['nodeid'])) ? $data['nodeid'] : null;
        $this->jobid  = (isset($data['jobid'])) ? $data['jobid'] : null;
        $this->schedule  = (isset($data['schedule'])) ? $data['schedule'] : null;
        $this->description  = (isset($data['description'])) ? $data['description'] : null;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

}