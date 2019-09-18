<?php 
use Phalcon\Cli\Task;

class MainTask extends Task
{
    public function CheckLogAction()
    {
      $main = new cliMain;
      $main->checkLog();
     
    }

}
