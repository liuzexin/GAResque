#Yii2-resque(best,easy)
##Install
You need to use composer
Primarily, You need to add the following code to**root package(project directory)**, because the newest php-resque is dev-master, the tagged version is oldest. 
```json
{
    "require":{
        ...
        "chrisboulton/php-resque": "@dev"
    }
}
```
Then run:
```bash
composer require ga/resque dev-master
```
 

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

3.Create `*Job.php` in models directory.

example:
```php
MyJob.php
<?php
namespace app\models;
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
**NOTICE:**You must enqueue with `\Yii::$app->resque->dequeue('default', 'app\models\MyJob', [1], true);`, Yii2 find the file by `autoloader` according to namesapce. 

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

3.Create `*Job.php` in models(include console,frontend,backend,common) directory.

example:
```php
MyJob.php
<?php
namespace backend\models;
namespace console\models;
namespace frontend\models;
namespace common\models;
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

**NOTICE:**You must enqueue with `\Yii::$app->resque->dequeue('default', 'backend\models\MyJob', [1], true);`, Yii2 find the file by `autoloader` according to namesapce.

## Usage

Enqueue and dequeue the job task.
```php
   \Yii::$app->resque->enqueue('default', 'BadJob', [1], true);
   \Yii::$app->resque->dequeue('default', 'BadJob', [1], true);
   \Yii::$app->resque->size('default');
   ...
```
More information you can also see the [php-resque][1].

**NOTICE:** `dequeue()`  not available now, can be use in the future.

Param `default` is queue name,`BadJob` is the class of which will complete the work. Param `[1]` is `array` params for `BadJob`. 
In the root of project directory, run following code:
```PHP
QUEUE=* ./yii resque
```

**NOTICE:**`*` means will start all queues.You can replace `*` with queue name or like this`QUEUE=default1,default2` will run specified queue.


[1]:https://github.com/chrisboulton/php-resque