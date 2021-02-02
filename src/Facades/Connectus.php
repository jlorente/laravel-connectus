<?php

/**
 * Part of the Connectus Laravel package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Connectus Laravel
 * @version    7.0.0
 * @author     Jose Lorente
 * @license    BSD License (3-clause)
 * @copyright  (c) 2019, Jose Lorente
 */

namespace Jlorente\Laravel\Connectus\Facades;

use Illuminate\Support\Facades\Facade;

class Connectus extends Facade
{

    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'connectus';
    }

}
