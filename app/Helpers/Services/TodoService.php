<?php

namespace App\Helpers\Services;

/*  The scripts below are based on dev.to
  * https://dev.to/safbalili/implement-crud-with-laravel-service-repository-pattern-1dkl
*/

use App\Helpers\Repositories\TodoRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class TodoService
{
  protected $todoRepo;

  public function __construct(TodoRepository $todoRepo)
  {
    $this->todoRepo = $todoRepo;
  }

  /*
  * Ini fungsi untuk menyimpan task baru
  */
  public function saveTodo(array $data)
  {
    $validator = Validator::make($data, [
      'title' => 'required|string|max:50',
      'description' => 'required|string|max:255',
      'status' => 'required|integer'
    ]);

    if ($validator->fails())
    {
      throw new InvalidArgumentException($validator->errors()->first());
    }

    $result = $this->todoRepo->create($data);

    return $result;
  }

  /*
  * Ini fungsi untuk menampilkan semua task
  */
  public function getAllTask()
  {
    $result = $this->todoRepo->getAll();
    return $result;
  }

  /*
  * Ini fungsi untuk melihat task berdasarkan ID
  */
  public function getById(string $id)
  {
    $result = $this->todoRepo->getById($id);
    return $result;
  }

  /*
  * Ini fungsi untuk mengubah task berdasarkan ID
  */
  public function editTask(array $data, string $id)
  {
    $validator = Validator::make($data, [
      'title' => 'required|string|max:50',
      'description' => 'required|string|max:255',
      'status' => 'required|integer'
    ]);

    if ($validator->fails())
    {
      throw new InvalidArgumentException($validator->errors()->first());
    }

    $result = $this->todoRepo->update($data, $id);
    return $result;
  }

  /*
  * Ini fungsi untuk menghapus task berdasarkan ID
  */
  public function deleteTask(string $id)
	{
		$result = $this->todoRepo->deleteTask($id);
		return $result;
	}

}
?>