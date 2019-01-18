<?php
/*
 * This file is part of Optimus Eloquent.
 *
 * (c) Nguyen Nhu Huy <huy@ses.vn>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace  nhuhuy\OptimusEloquent\Traits;

trait OptimusEloquentTrait
{
    /**
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        switch ($method) {
            case 'find':
                $parameters[0] = $this->getOptimus()->decode($parameters[0]);
                break;
            case 'whereIn':
                if ($parameters[0] == 'id') {
                    $parameters[1] = $this->mapToOptimusIds($parameters[1]);
                }
                break;
        }
        return parent::__call($method, $parameters);
    }

    /**
     * @param array $array
     * @return array
     */
    private function mapToOptimusIds(array $array): array
    {
        $array = array_map(function ($value) {
            return $this->getOptimus()->decode($value);
        }, $array);
        return $array;
    }

    /**
     * @param $value
     * @return int
     */
    public function getIdAttribute($value): int
    {
        return $this->getOptimus()->encode($value);
    }

    /**
     * @return \Illuminate\Foundation\Application|mixed
     */
    private function getOptimus()
    {
        return app('optimus');
    }
}