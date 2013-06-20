<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Api\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;

#use Album\Model\Album;
#use Album\Form\AlbumForm;
#use Album\Model\AlbumTable;
use Zend\View\Model\JsonModel;


class ApiController extends AbstractRestfulController
{
    public function getList()
    {
        $result = new JsonModel(array('list' => 'success'));
        return $result;
    }

    public function get($id)
    {
        $result = new JsonModel(array('get' => 'success', 'id' => $id));
        $result->setTerminal(true);
        return $result;
    }

    public function create($data)
    {
        $result = new JsonModel(array('create' => "success", "data" => $data));
        $result->setTerminal(true);
        return $result;
    }

    public function update($id, $data)
    {
        $result = new JsonModel(array('update' => "success", 'data' => $data, 'id' => $id));
        $result->setTerminal(true);
        return $result;
    }

    public function delete($id)
    {
        $result = new JsonModel(array('remove' => 'success', 'id' => $id, "who" => $_SERVER['REMOTE_ADDR']));
        $result->setTerminal(true);
        return $result;
    }
}