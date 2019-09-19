<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class DpLogController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for dp_log
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'DpLog', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $dp_log = DpLog::find($parameters);
        if (count($dp_log) == 0) {
            $this->flash->notice("The search did not find any dp_log");

            $this->dispatcher->forward([
                "controller" => "dp_log",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $dp_log,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a dp_log
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $dp_log = DpLog::findFirstByid($id);
            if (!$dp_log) {
                $this->flash->error("dp_log was not found");

                $this->dispatcher->forward([
                    'controller' => "dp_log",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $dp_log->id;

            $this->tag->setDefault("id", $dp_log->id);
            $this->tag->setDefault("ApplicationName", $dp_log->ApplicationName);
            $this->tag->setDefault("Source", $dp_log->Source);
            $this->tag->setDefault("InstanceId", $dp_log->InstanceId);
            $this->tag->setDefault("Message", $dp_log->Message);
            $this->tag->setDefault("StackTrace", $dp_log->StackTrace);
            $this->tag->setDefault("CreatedOn", $dp_log->CreatedOn);
            
        }
    }

    /**
     * Creates a new dp_log
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "dp_log",
                'action' => 'index'
            ]);

            return;
        }

        $dp_log = new DpLog();
        $dp_log->applicationName = $this->request->getPost("ApplicationName");
        $dp_log->source = $this->request->getPost("Source");
        $dp_log->instanceId = $this->request->getPost("InstanceId");
        $dp_log->message = $this->request->getPost("Message");
        $dp_log->stackTrace = $this->request->getPost("StackTrace");
        $dp_log->createdOn = $this->request->getPost("CreatedOn");
        

        if (!$dp_log->save()) {
            foreach ($dp_log->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "dp_log",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("dp_log was created successfully");

        $this->dispatcher->forward([
            'controller' => "dp_log",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a dp_log edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "dp_log",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $dp_log = DpLog::findFirstByid($id);

        if (!$dp_log) {
            $this->flash->error("dp_log does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "dp_log",
                'action' => 'index'
            ]);

            return;
        }

        $dp_log->applicationName = $this->request->getPost("ApplicationName");
        $dp_log->source = $this->request->getPost("Source");
        $dp_log->instanceId = $this->request->getPost("InstanceId");
        $dp_log->message = $this->request->getPost("Message");
        $dp_log->stackTrace = $this->request->getPost("StackTrace");
        $dp_log->createdOn = $this->request->getPost("CreatedOn");
        

        if (!$dp_log->save()) {

            foreach ($dp_log->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "dp_log",
                'action' => 'edit',
                'params' => [$dp_log->id]
            ]);

            return;
        }

        $this->flash->success("dp_log was updated successfully");

        $this->dispatcher->forward([
            'controller' => "dp_log",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a dp_log
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $dp_log = DpLog::findFirstByid($id);
        if (!$dp_log) {
            $this->flash->error("dp_log was not found");

            $this->dispatcher->forward([
                'controller' => "dp_log",
                'action' => 'index'
            ]);

            return;
        }

        if (!$dp_log->delete()) {

            foreach ($dp_log->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "dp_log",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("dp_log was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "dp_log",
            'action' => "index"
        ]);
    }

}
