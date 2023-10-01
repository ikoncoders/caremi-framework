<?php declare(strict_types=1);
namespace Caremi\Base\Traits;

use Caremi\Base\Exception\BaseException;
use Caremi\Base\Exception\BaseInvalidArgumentException;

trait ModelCastingTrait
{

    /**
     * two way casting cast a data type back and fourth
     *
     * @return void
     */
    public function casting(array $casters = [])
    {
        if (isset($this->cast)) {
            if (is_array($this->cast) && count($this->cast) > 0) {
                foreach ($this->cast as $key => $value) {
                    if (!in_array($value, $casters)) {
                        throw new BaseInvalidArgumentException($value . ' casting type is not supported.');
                    }
                    $this->resolveCast($key, $value);
                }
            }
        }
    }

    private function resolveCast(string $key, mixed $value)
    {
        if (empty($key)) {
            throw new BaseException('');
        }
        switch ($value) {
            case 'array_json':
                if (isset($this->getEntity()->$key) && $this->getEntity()->$key !== '') {
                    $this->getEntity()->$key = json_encode($value);
                }
                break;
        }
    }
}
