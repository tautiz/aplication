<?php

namespace App\Repositories;

use App\Exceptions\ModelNotFoundException;
use App\Models\ModelInterface;
use Core\ConfigService;
use Exception;
use PDO;
use ReflectionClass;
use stdClass;
use Throwable;

abstract class BaseRepository implements RepositoryInterface
{
    protected const TABLE_NAME = null;

    /**
     * @var PDO
     */
    private PDO $connection;

    /**
     * @param ConfigService $configService
     */
    public function __construct(private readonly ConfigService $configService)
    {
        $conf = (array)$this->configService->get('db_settings');
        $host = $conf['host'] ?? 'mysql';
        $dbname = $conf['dbname'] ?? 'application';
        $username = $conf['username'] ?? 'root';
        $password = $conf['password'] ?? 'root';
        $this->connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }

    /**
     * @return string
     */
    protected function getTable(): string
    {
        $tableName = $this->getModeratedClassReflectionName().'s';

        return static::TABLE_NAME !== null ? static::TABLE_NAME : $tableName;
    }

    /**
     * @return ModelInterface
     */
    public function getModel(): ModelInterface
    {
        $parsedClassName = 'App\Models\\'.ucfirst($this->getModeratedClassReflectionName());

        return new $parsedClassName;
    }

    /**
     * @return string
     */
    private function getModeratedClassReflectionName(): string
    {
        $classNameSpace = new ReflectionClass($this);

        return strtolower(str_replace('Repository', '', $classNameSpace->getShortName()));
    }

    /**
     * @throws ModelNotFoundException
     */
    public function all(): array|bool
    {
        $query = 'SELECT * FROM '.$this->getTable();

        $stmt = $this->getConnection()->prepare($query);

        $stmt->execute();

        return $this->getData($stmt);
    }

    /**
     * @param string $id
     * @return array|bool
     * @throws ModelNotFoundException
     */
    public function findOrFail(string $id): array|bool
    {
        $table = $this->getTable();

        $query = 'SELECT * FROM '.$table.' where id = ?';

        $stmt = $this->getConnection()->prepare($query);

        $stmt->execute([$id]);

        return $this->getData($stmt);
    }

    /**
     * @param bool|\PDOStatement $stmt
     * @return array
     * @throws ModelNotFoundException
     */
    protected function getData(bool|\PDOStatement $stmt): array
    {
        try {
            $class = get_class($this->getModel());
        } catch (Throwable $e) {
            $class = get_class(new stdClass());
        }
        $stmt->setFetchMode(PDO::FETCH_CLASS, $class);

        $object = $stmt->fetchAll();

        if (empty($object)) {
            throw new ModelNotFoundException('Can\'t find items.');
        }

        return $object;
    }
}
