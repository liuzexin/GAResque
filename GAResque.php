<?php
/**
 * Created by PhpStorm.
 * User: xin
 * Date: 16/11/24
 * Time: 下午4:48
 */

namespace ga\resque;
use \yii\base\Component;
require_once  \Yii::getAlias('@vendor'). '/chrisboulton/php-resque/lib/Resque.php';
class GAResque extends Component
{
    public $server = 'localhost';

    public $port = '6379';

    public $database = 0;

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        \Resque::setBackend($this->server .':'. $this->port,$this->database);
    }

    /**
     * Create a new job and save it to the specified queue.
     *
     * @param string $queue_name The name of the queue to place the job in.
     * @param string $job_class The name of the class that contains the code to execute the job.
     * @param array $param Any optional arguments that should be passed when the job is executed.
     * @param boolean $track_status Set to true to be able to monitor the status of a job.
     *
     * @return string
     */
    public function enqueue($queue_name, $job_class, $param, $track_status = true){
        return \Resque::enqueue($queue_name, $job_class, $param, $track_status);
    }
    /**
     * Remove items of the specified queue
     *
     * @param string $queue_name The name of the queue to fetch an item from.
     * @param array $items
     * @return integer number of deleted items
     */

    public function dequeue($queue_name, $items){
        return \Resque::dequeue($queue_name, $items);
    }
}