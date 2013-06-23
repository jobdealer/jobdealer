<?php
namespace Application\Model;

class Node
{
    public $id;
    public $nodename;
    public $ipaddr;
    public $description;
    public $lastseen;

    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->nodename = (isset($data['nodename'])) ? $data['nodename'] : null;
        $this->ipaddr  = (isset($data['ipaddr'])) ? $data['ipaddr'] : null;
        $this->description  = (isset($data['description'])) ? $data['description'] : null;
        $this->lastseen  = (isset($data['lastseen'])) ? $data['lastseen'] : null;
    }

}