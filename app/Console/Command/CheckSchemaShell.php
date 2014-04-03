<?php
App::uses('AppShell', 'Console/Command');
App::uses('Configure', 'Core');
App::uses('Controller', 'Controller');
App::uses('ComponentCollection', 'Controller');
App::uses('AclComponent', 'Controller/Component');
App::uses('DbAcl', 'Model');

class CheckSchemaShell extends AppShell
{
    public $uses = array('Group');

    public function main()
    {
        $this->out("\n\nChecking models against current DB schema....\n\n");

        $models = $this->loadModels(true);
        $results = array();
        $score = array('found' => 0, 'missing' => 0);

        foreach ($models as $model) {
            $result = $this->compareModelAtributesWithSchema($model);
            $results[$model->name] = $result;
        }

        foreach ($results as $modelname => $atributes) {
            foreach ($atributes as $key => $value) {

                if ($value === true) {
                    $score['found']++;
                    $output = sprintf("%-20s %-20s %-20s", $modelname, $key, 'OK');
                    $this->out("<success>".$output."</success>");
                } else {
                    $score['missing']++;
                    $output = sprintf("%-20s %-20s %-20s", $modelname, $key, 'MISSING IN SCHEMA');
                    $this->out("<warning>".$output."</warning>");
                }
            }
        }

        $this->out("********************************************************");

        if ($score['missing'] > 0) {
            $this->out("<warning>Ended with ".$score['missing']." missing collumns in schema.</warning>");
        } else {
            $this->out("<success>Ended without any errors.</success>");
        }
    }

    private function loadModels($onlyWithTable = false)
    {
        $models = array();
        $modelNames = App::objects('model');

        foreach ($modelNames as $modelName) {
            if ($modelName !== 'AppModel') {
                App::import('Model', $modelName);
                $model = new $modelName();

                if ($onlyWithTable === true && $model->useTable !== false) {
                    $models[$modelName] = $model;
                } elseif ($onlyWithTable === false) {
                    $models[$modelName] = $model;
                }
            }
        }

        ksort($models);

        return $models;
    }

    private function compareModelAtributesWithSchema($model)
    {
        $modelAtributes = get_object_vars($model);
        $schema = $model->schema();
        $results = array();

        foreach ($modelAtributes['validate'] as $key => $value) {
            $results[$key] = array_key_exists($key,  $schema);
        }

        return $results;
    }
}
