<?php
namespace App\Helpers\Interfaces\Contracts;

/*  The script below is based on dev.to
  * https://dev.to/carlomigueldy/getting-started-with-repository-pattern-in-laravel-using-inheritance-and-dependency-injection-2ohe
*/

use Jenssegers\Mongodb\Collection;
use Jenssegers\Mongodb\Eloquent\Model;

interface RepositoryInterface
{
  public function all(array $columns = ['*'], array $relations = []): Collection;

  public function allTrashed(): Collection;

  public function findById(
    int $modelId,
    array $columns = ['*'],
    array $relations = [],
    array $appends = []
  ): ?Model;

  public function findTrashedById(int $modelId): ?Model;

  public function findOnlyTrashedById(int $modelId): ?Model;
  
  public function create(array $payload): ?Model;

  public function update(array $payload, $id): bool;

  public function deleteById($id): bool;

  public function restoreById($id): bool;

  public function permanentlyDeleteById($id): bool;
}
?>