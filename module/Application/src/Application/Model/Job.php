<?php
namespace Application\Model;

use Zend\Form\Annotation as Form;

class Job
{
    /**
     * @Form\Required(false)
     * @Form\Attributes({"type":"hidden"})
     */
    public $id;
    /**
     * @Form\Required(false)
     * @Form\Attributes({"type":"text"})
     * @Form\Options({"label":"Description"})
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Filter({"name":"StripTags"})
     */
    public $description;
    /**
     * @Form\Required(true)
     * @Form\Attributes({"type":"text"})
     * @Form\Options({"label":"Action"})
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Filter({"name":"StripTags"})
     */
    public $action;
    /**
     * @Form\Required(true)
     * @Form\Attributes({"type":"text"})
     * @Form\Options({"label":"Default Schedule"})
     * @Form\Filter({"name":"StringTrim"})
     */
    public $defaultschedule;
    /**
     * @Form\Required(true)
     * @Form\Attributes({"type":"text"})
     * @Form\Options({"label":"Estimated Duration"})
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Validator({
     *  "name":"regex",
     *  "options": {
     *      "pattern": "/^\d+:\d{2}:\d{2}$/",
     *      "messages": {
     *          "regexInvalid":"Regex is invalid, Booo!",
     *          "regexNotMatch": "Input doesn't match, bleeeeh!",
     *          "regexErrorous": "Internal error, i'm like wtf!"
     *      }
     *  }
     * })
     */
    public $estimatedduration;

    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->description = (isset($data['description'])) ? $data['description'] : null;
        $this->action  = (isset($data['action'])) ? $data['action'] : null;
        $this->defaultschedule  = (isset($data['defaultschedule'])) ? $data['defaultschedule'] : null;
        $this->estimatedduration  = (isset($data['estimatedduration'])) ? $data['estimatedduration'] : null;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}