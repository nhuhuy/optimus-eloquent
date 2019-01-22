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
     * @param $value
     * @return int
     */
    public function getHashIdAttribute($value): int
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