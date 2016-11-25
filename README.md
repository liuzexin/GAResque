#Yii2-resque(best,easy)

##Set up

###For Yii2-basic

1.Copy the `ResqueController.txt` to command directory and renamed `ResqueController.php`, and then modify the namespace to `app\commands`.


2.Modify console.php in config directory, add the following code.
```php
   'resque' => [
       'class' => 'ga\resque\GAResque',
       'server' => '127.0.0.1',     // Redis server address
       'port' => '6379',            // Redis server port
       'database' => 0,             // Redis database number
   ],
```
3.Enqueue and dequeue the job task.
```php
   \Yii::$app->resque->enqueue('default', 'BadJob', [1], true);
   \Yii::$app->resque->dequeue('default', 'BadJob', [1], true);
```
Param `default` is queue name,`BadJob` is the class of which will complete the work. Param `[1]` is `array` params for `BadJob`. 
4.Create `*Job.php` in models directory.

example:
```php
MyJob.php
<?php
class MyJob
{ 
    public function setUp()
    {
        // ... Set up environment for this job
    }    
    public function perform()
    {
        echo "1\n";
        $this->args['name'];
    }
    
    public function tearDown()
    {
        // ... Remove environment for this job
    }
}
```
The `perform()` method  will deal with work,`setUp()` will run at begin of work, `tearDown()`will run at finished work.
*NOTICE:*You must name the job file must *end with* `Job.php`.

### For Yii2-advanced

1.Copy the `ResqueController.txt` to console/controllers directory and renamed `ResqueController.php`, and then modify the namespace to `console\controllers`.


2.Modify console/main.php in config directory, add the following code.
```php
   'resque' => [
       'class' => 'ga\resque\GAResque',
       'server' => '127.0.0.1',     // Redis server address
       'port' => '6379',            // Redis server port
       'database' => 0,             // Redis database number
   ],
```
3.Enqueue and dequeue the job task.
```php
   \Yii::$app->resque->enqueue('default', 'BadJob', [1], true);
   \Yii::$app->resque->dequeue('default', 'BadJob', [1], true);
```
Param `default` is queue name,`BadJob` is the class of which will complete the work. Param `[1]` is `array` params for `BadJob`. 
4.Create `*Job.php` in models directory.

example:
```php
MyJob.php
<?php
class MyJob
{ 
    public function setUp()
    {
        // ... Set up environment for this job
    }    
    public function perform()
    {
        echo "1\n";
        $this->args['name'];
    }
    
    public function tearDown()
    {
        // ... Remove environment for this job
    }
}
```
The `perform()` method  will deal with work,`setUp()` will run at begin of work, `tearDown()`will run at finished work.
*NOTICE:*You must name the job file must *end with* `Job.php`.


## Usage


```PHP
QUEUE=* php yii resque
```
*NOTICE*`*` means will start all queue.You can replace `*` with queue name or like this`QUEUE=default1,default2` will run specified queue.


