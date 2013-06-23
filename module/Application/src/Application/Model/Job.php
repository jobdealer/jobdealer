<?php
namespace Application\Model;

class Job
{
    public $id;
    public $description;
    public $action;
    public $defaultschedule;
    public $estimatedduration;

    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->description = (isset($data['description'])) ? $data['description'] : null;
        $this->action  = (isset($data['action'])) ? $data['action'] : null;
        $this->defaultschedule  = (isset($data['defaultschedule'])) ? $data['defaultschedule'] : null;
        $this->estimatedduration  = (isset($data['estimatedduration'])) ? $data['estimatedduration'] : null;
    }

}