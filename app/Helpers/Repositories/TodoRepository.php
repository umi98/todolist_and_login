<?php

namespace App\Helpers\Repositories;

/*  The scripts below are based on
  * dev.to : https://dev.to/safbalili/implement-crud-with-laravel-service-repository-pattern-1dkl
  * and previous project
*/

use App\Models\Todo;

class TodoRepository
{
  private $todo;
  
  public function __construct(Todo $todo)
  {
    $this->todo = $todo;
  }

  /*
  * Ini fungsi untuk membuat task baru
  */
  public function create(array $data)
  {
    $todo = new $this->todo;
    
    $todo->title = $data['title'];
    $todo->description = $data['description'];
    $todo->status = $data['status'];

    $todo->save();

    return $todo->fresh();
  }

  /*
  * Ini fungsi untuk mengubah task berdasarkan ID
  */
  public function update(array $data, string $id)
  {
    $todo = $this->todo->find($id);

    $todo->title = $data['title'];
    $todo->description = $data['description'];
    $todo->status = $data['status'];

    $result = $todo->update();
    return $result;
  }

  /*
  * Ini fungsi untuk melihat semua task
  */
  public function getAll()
  {
    $result = $this->todo->get([]);
    return $result;
  }

  /*
  * Ini fungsi untuk melihat task berdasarkan ID
  */
  public function getById(string $id)
  {
    $result = $this->todo->find(['_id'=>$id]);
    return $result;
  }

  /*
  * Ini fungsi untuk menghapus task berdasarkan ID
  */
  public function deleteTask(string $id)
	{
		$result = $this->todo->find($id);
    $result->delete();
		return $result;
	}



}
?>