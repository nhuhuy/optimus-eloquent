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

namespace nhuhuy\OptimusEloquent;

use Jenssegers\Optimus\Optimus;

class OptimusFactory
{
    /**
     * Make a new Optimus client.
     * @param array $config
     * @return Optimus
     */
    public function make(array $config):Optimus
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }

    /**
     * Get the Optimus client.
     * @param array $config
     * @return Optimus
     */
    protected function getClient(array $config): Optimus
    {
        return new Optimus($config['prime'], $config['inverse'], $config['random']);
    }

    /**
     * Get the configuration data.
     * @param array $config
     * @return array
     */
    protected function getConfig(array $config): array
    {
        return [
            'prime' => array_get($config, 'prime', 0),
            'inverse' => array_get($config, 'inverse', 0),
            'random' => array_get($config, 'random', 0)
        ];
    }
}