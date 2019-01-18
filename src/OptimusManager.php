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

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;
use Jenssegers\Optimus\Optimus;

class OptimusManager extends AbstractManager
{
    /**
     * The factory instance.
     * @var OptimusFactory
     */
    protected $factory;

    /**
     * OptimusManager constructor.
     * @param Repository $config
     * @param OptimusFactory $factory
     */
    public function __construct(Repository $config, OptimusFactory $factory)
    {
        parent::__construct($config);

        $this->factory = $factory;
    }


    /**
     * Create the connection instance.
     * @param array $config
     * @return \Jenssegers\Optimus\Optimus
     */
    protected function createConnection(array $config): Optimus
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     * @return string
     */
    protected function getConfigName(): string
    {
        return 'optimus';
    }

    /**
     * Get the factory instance.
     * @return OptimusFactory
     */
    public function getFactory(): OptimusFactory
    {
        return $this->factory;
    }
}