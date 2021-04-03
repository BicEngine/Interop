<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Interop\Internal;

use FFI\CData;

/**
 * @internal TypeSerializersTrait is an internal library trait, please do not use it in your code.
 * @psalm-internal Bic\Interop
 */
trait TypeSerializersTrait
{
    /**
     * @param CData $cdata
     * @return string
     */
    public static function toString(CData $cdata): string
    {
        return \FFI::string($cdata);
    }

    /**
     * @param CData $cdata
     * @return int
     */
    public static function toInt(CData $cdata): int
    {
        return (int)$cdata->cdata;
    }

    /**
     * @param CData $cdata
     * @return float
     */
    public static function toFloat(CData $cdata): float
    {
        return (float)$cdata->cdata;
    }

    /**
     * @param CData $cdata
     * @return bool
     */
    public static function toBool(CData $cdata): bool
    {
        return (bool)$cdata->cdata;
    }

    /**
     * @param CData $array
     * @param int $size
     * @return array
     */
    public static function toArray(CData $array, int $size): array
    {
        $data = [];

        for ($i = 0; $i < $size; ++$i) {
            $data[] = $array[$i];
        }

        return $data;
    }
}
