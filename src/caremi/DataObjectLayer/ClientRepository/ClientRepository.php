<?php declare(strict_types=1);
namespace Caremi\DataObjectLayer\ClientRepository;

use Throwable;
use Caremi\DataObjectLayer\EntityManager\EntityManagerInterface;
use Caremi\DataObjectLayer\ClientRepository\ClientRepositoryInterface;

class ClientRepository implements ClientRepositoryInterface
{
    /** @var EntityManagerInterface */
    protected EntityManagerInterface $em;

    /**
     * Main class constructor which requires the entity manager object. This object
     * is passed within the client repository factory.
     *
     * @param EntityManagerInterface $em
     * @return void
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getClientCrud(): object
    {
        return $this->em->getCrud();
    }

    /**
     * @inheritdoc
     *
     * @param array $fields
     * @param string|null $primaryKey
     * @return boolean
     */
    public function save(array $fields = [], ?string $primaryKey = null): bool
    {
        try {
            if (is_array($fields) && count($fields) > 0) {
                if ($primaryKey != null && is_string($primaryKey)) {
                    return $this->em->getCrud()->update($fields, $primaryKey);
                } elseif ($primaryKey === null) {
                    return $this->em->getCrud()->create($fields);
                }
            }
        } catch (Throwable $throw) {
            throw $throw;
        }
    }

    /**
     * @inheritdoc
     *
     * @param array $condition
     * @return boolean
     */
    public function drop(array $condition): bool
    {
        try {
            if (is_array($condition) && count($condition) > 0) {
                return $this->em->getCrud()->delete($condition);
            }
        } catch (Throwable $throw) {
            throw $throw;
        }
    }

    /**
     * @inheritdoc
     *
     * @param array $conditions
     * @return array
     */
    public function get(array $selectors = [], array $conditions = []): array
    {
        try {
            return $this->em->getCrud()->read($selectors, $conditions);
        } catch (Throwable $throw) {
            throw $throw;
        }
    }


    public function validate(): void
    {
    }
}
