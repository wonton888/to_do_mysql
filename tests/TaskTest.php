<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Task.php";

    $server = 'mysql:host=localhost;dbname=to_do_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class TaskTest extends PHPUnit_Framework_TestCase
    {

          protected function tearDown()
          {
                Task::deleteAll();

          }

          function test_save()
          {
              //Arrange
              $name = "Home stuff";
              $id = null;
              $test_category = new Category($name, $id);
              $test_category->save();

              $description = "Wash the dog";
              $category_id = $test_category->getId();
              $test_Task = new Task($description, $id, $category_id);

              //Act
              $test_Task->save();

              //Assert
              $result = Task::getAll();
              $this->assertEquals($test_Task, $result[0]);
          }//end function


          function test_getAll()
          {
              //Arrange
              $name = "Home stuff";
              $id = null;
              $test_category = new Category($name, $id);
              $test_category->save();

              $description = "Wash the dog";
              $category_id = $test_category->getId();
              $test_Task = new Task($description, $id, $category_id);
              $test_Task->save();


              $description2 = "Water the lawn";
              $test_Task2 = new Task($description2, $id, $category_id);
              $test_Task2->save();


              //Act
              $result = Task::getAll();

              //Assert
              $this->assertEquals([$test_Task,$test_Task2], $result);
          }//end function

          function test_deleteAll()
          {
              //Arrange
              $name = "Home stuff";
              $id = null;
              $test_category = new Category($name, $id);
              $test_category->save();

              $description = "Wash the dog";
              $category_id = $test_category->getId();
              $test_Task = new Task($description, $id, $category_id);
              $test_Task->save();

              $description2 = "Water the lawn";
              $test_Task2 = new Task($description2, $id, $category_id);
              $test_Task2->save();


              //Act
              Task::deleteAll();

              //Assert
              $result = Task::getAll();
              $this->assertEquals([], $result);
          }//end function

          function test_getId()
          {
              //Arrange
              $name = "Home stuff";
              $id = null;
              $test_category = new Category($name, $id);
              $test_category->save();

              //Arrange
              $description = "Wash the dog";
              $category_id = $test_category->getId();
              $test_Task = new Task($description, $id, $category_id);
              $test_Task->save();

              //Act
              $result = $test_Task->getId();

              //Assert
              $this->assertEquals(true, is_numeric($result));
          }

          function test_getCategoryId()
            {
                //Arrange
                $name = "Home stuff";
                $id = null;
                $test_category = new Category($name, $id);
                $test_category->save();

                $description = "Wash the dog";
                $category_id = $test_category->getId();
                $test_task = new Task($description, $id, $category_id);
                $test_task->save();

                //Act
                $result = $test_task->getCategoryId();

                //Assert
                $this->assertEquals(true, is_numeric($result));
            }

         function test_find()
            {
                //Arrange
                $name = "Home stuff";
                $id = null;
                $test_category = new Category($name, $id);
                $test_category->save();

                $description = "Wash the dog";
                $category_id = $test_category->getId();
                $test_task = new Task($description, $id, $category_id);
                $test_task->save();

                $description2 = "Water the lawn";
                $test_task2 = new Task($description2, $id, $category_id);
                $test_task2->save();

            //Act
                $result = Task::find($test_task->getId());

            //Assert
                $this->assertEquals($test_task, $result);

            }


    }// end class
?>
