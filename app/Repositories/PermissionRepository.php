<?php

namespace App\Repositories;

use App\Exceptions\ModelNotFoundException;

class PermissionRepository extends BaseRepository
{
    protected const TABLE_NAME = 'groups_permissions';

    /**
     * @throws ModelNotFoundException
     */
    public function findByGroupId(string $groupId): array
    {
        $table = $this->getTable();

        $query = 'SELECT * FROM '.$table.' where group_id = ?';

        $stmt = $this->getConnection()->prepare($query);

        $stmt->execute([$groupId]);

        return $this->getData($stmt);
    }
}
