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
        $result = new JsonModel(array('data' => 'success'));
        return $result;
    }

    public function get($id)
    {
        $result = new JsonModel(array('data' => 'success'));
        $result->setTerminal(true);
        return $result;
    }

    public function create($data)
    {
        # code...
    }

    public function update($id, $data)
    {
        # code...
    }

    public function delete($id)
    {
        # code...
    }
}