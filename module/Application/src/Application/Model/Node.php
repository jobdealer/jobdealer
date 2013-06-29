<?php
namespace Application\Model;

use Zend\Form\Annotation as Form;

class Node
{
    /**
     * @Form\Required(false)
     * @Form\Attributes({"type":"hidden"})
     */
    public $id;

    /**
     * @Form\Required(true)
     * @Form\Attributes({"type":"text"})
     * @Form\Options({"label":"Nodename"})
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Validator({"name":"Hostname"})
     */
    public $nodename;

    /**
     * @Form\Required(true)
     * @Form\Attributes({"type":"text"})
     * @Form\Options({"label":"Ip address"})
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Validator({"name":"Ip"})
     */
    public $ipaddr;

    /**
     * @Form\Required(false)
     * @Form\Attributes({"type":"text"})
     * @Form\Options({"label":"Description"})
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Filter({"name":"StripTags"})
     */
    public $description;

    /**
     * @Form\Required(false)
     * @Form\Attributes({"type":"hidden"})
     */
    public $lastseen;

    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->nodename = (isset($data['nodename'])) ? $data['nodename'] : null;
        $this->ipaddr  = (isset($data['ipaddr'])) ? $data['ipaddr'] : null;
        $this->description  = (isset($data['description'])) ? $data['description'] : null;
        $this->lastseen  = (isset($data['lastseen'])) ? $data['lastseen'] : null;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

}