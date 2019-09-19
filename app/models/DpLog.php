<?php

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

    public static function fromInput($dependencyInjector, $modelName, $data)
    {
        $conditions = array();
        if (count($data)) {
            $metaData = $dependencyInjector->getShared('modelsMetadata');
            $model = new $modelName();
            $dataTypes = $metaData->getDataTypes($model);
            $columnMap = $metaData->getReverseColumnMap($model);
            $bind = array();
            foreach ($data as $fieldName => $value) {
                if (isset($columnMap[$fieldName])) {
                    $field = $columnMap[$fieldName];
                } else {
                    continue;
                }
                if (isset($dataTypes[$field])) {
                    if (!is_null($value)) {
                        if ($value != '') {                         
                            if ($dataTypes[$field] == 2) {                              
                                $condition = $fieldName . " Greater than or equal :" . $fieldName . ":";                             
                                $bind[$fieldName] = '%' . $value . '%';
                            } else {                                
                                $condition = $fieldName . ' = :' . $fieldName . ':';
                                $bind[$fieldName] = $value;
                            }
                            $conditions[] = $condition;
                        }
                    }
                }
            }
        }
        $criteria = new Criteria();
        if (count($conditions)) {           
            $criteria->where(join(' AND ', $conditions));
            $criteria->bind($bind);
        }
        return $criteria;
    }
}
