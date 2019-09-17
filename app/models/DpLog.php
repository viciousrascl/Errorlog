<?php

namespace errorlog;

class DpLog extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $applicationName;

    /**
     *
     * @var string
     */
    public $source;

    /**
     *
     * @var integer
     */
    public $instanceId;

    /**
     *
     * @var string
     */
    public $message;

    /**
     *
     * @var string
     */
    public $stackTrace;

    /**
     *
     * @var string
     */
    public $createdOn;



    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("errorlog");
        $this->setSource("dp_log");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'dp_log';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return DpLog[]|DpLog|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return DpLog|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
