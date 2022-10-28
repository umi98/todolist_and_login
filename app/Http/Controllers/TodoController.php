<?php

namespace App\Http\Controllers;

/*  The scripts below are based on dev.to
  * https://dev.to/safbalili/implement-crud-with-laravel-service-repository-pattern-1dkl
*/

use App\Helpers\Services\TodoService;
// use App\Models\Todo;
use Exception;
use Illuminate\Http\Request;

class TodoController extends Controller
{
  private TodoService $todoService;

  public function __construct(TodoService $todoService)
  {
    $this->todoService = $todoService;
  }

  /*
  * Ini fungsi untuk melihat semua task
  */
  public function showTask()
  {
    $result = $this->todoService->getAllTask();
    return response()->json($result);
  }

  /*
  * Ini fungsi untuk menambah task
  */
  public function addTask(Request $request)
  {
    $data = $request->only([
      'title',
      'description',
      'status'
    ]);

    $result = $this->todoService->saveTodo($data);
    return response()->json($result);
  }

  /*
  * Ini fungsi untuk melihat task berdasarkan ID
  */
  public function viewTask($id)
  {
    $result = $this->todoService->getById($id);
    return response()->json($result);
  }

  /*
  * Ini fungsi untuk mengubah task berdasarkan ID
  */
  public function updateTask(Request $request, $id)
  {
    $data = $request->only([
      'title',
      'description',
      'status'
    ]);

    $this->todoService->editTask($data, $id);

    $result = $this->todoService->getById($id);

		return response()->json($result);
  }

  /*
  * Ini fungsi untuk menghapus task berdasarkan ID
  */
  public function deleteTask($id)
  {
    $existTask = $this->todoService->getById($id);

		if(!$existTask)
		{
			return response()->json([
				"message"=> "Task ".$id." tidak ada"
			], 401);
		}

		$this->todoService->deleteTask($id);

		return response()->json([
			'message'=> 'Success delete task '.$id
		]);
  }
}
