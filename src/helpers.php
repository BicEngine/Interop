<?php

/**
 * This file is part of Interop package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Interop;

use FFI\CData;

if (! function_exists('struct')) {
    /**
     * @param CData $cdata
     * @param iterable $properties
     * @return CData
     */
    function struct(CData $cdata, iterable $properties): CData
    {
        foreach ($properties as $property => $value) {
            $cdata->$property = $value;
        }

        return $cdata;
    }
}

if (! function_exists('ptr')) {
    /**
     * @param CData $cdata
     * @return CData
     */
    function ptr(CData $cdata): CData
    {
        return \FFI::addr($cdata);
    }
}

if (! function_exists('memcpy')) {
    /**
     * Copies $size bytes from memory area $source to memory area $target.
     * $source may be any native data structure (FFI\CData) or PHP string.
     *
     * @param CData $target
     * @param mixed $source
     * @param int $size
     */
    function memcpy(CData $target, $source, int $size): void
    {
        \FFI::memcpy($target, $source, $size);
    }
}

if (! function_exists('memcmp')) {
    /**
     * Compares $size bytes from memory area $a and $b.
     *
     * @param CData|string $a
     * @param CData|string $b
     * @param int $size
     * @return int
     */
    function memcmp($a, $b, int $size): int
    {
        return \FFI::memcmp($a, $b, $size);
    }
}

if (! function_exists('memset')) {
    /**
     * Fills the $size bytes of the memory area pointed to by $target with
     * the constant byte $byte.
     *
     * @param CData $target
     * @param int $byte
     * @param int $size
     */
    function memset(CData $target, int $byte, int $size): void
    {
        \FFI::memset($target, $byte, $size);
    }
}

if (! function_exists('free')) {
    /**
     * Manually removes previously created "not-owned" data structure.
     *
     * @param CData ...$cdata
     * @return void
     */
    function free(CData ...$cdata): void
    {
        foreach ($cdata as $ptr) {
            \FFI::free($ptr);
        }
    }
}

if (! function_exists('int8')) {
    /**
     * @param int|int[] $value
     * @param bool $owned
     * @return CData
     */
    function int8($value = 0, bool $owned = false): CData
    {
        if (\is_iterable($value)) {
            return Type::int8Array($value, $owned);
        }

        return Type::int8($value, $owned);
    }
}

if (! function_exists('uint8')) {
    /**
     * @param int|int[] $value
     * @param bool $owned
     * @return CData
     */
    function uint8($value = 0, bool $owned = false): CData
    {
        if (\is_iterable($value)) {
            return Type::uint8Array($value, $owned);
        }

        return Type::uint8($value, $owned);
    }
}

if (! function_exists('int16')) {
    /**
     * @param int|int[] $value
     * @param bool $owned
     * @return CData
     */
    function int16($value = 0, bool $owned = false): CData
    {
        if (\is_iterable($value)) {
            return Type::int16Array($value, $owned);
        }

        return Type::int16($value, $owned);
    }
}

if (! function_exists('uint16')) {
    /**
     * @param int|int[] $value
     * @param bool $owned
     * @return CData
     */
    function uint16($value = 0, bool $owned = false): CData
    {
        if (\is_iterable($value)) {
            return Type::uint16Array($value, $owned);
        }

        return Type::uint16($value, $owned);
    }
}

if (! function_exists('int32')) {
    /**
     * @param int|int[] $value
     * @param bool $owned
     * @return CData
     */
    function int32($value = 0, bool $owned = false): CData
    {
        if (\is_iterable($value)) {
            return Type::int32Array($value, $owned);
        }

        return Type::int32($value, $owned);
    }
}

if (! function_exists('uint32')) {
    /**
     * @param int|int[] $value
     * @param bool $owned
     * @return CData
     */
    function uint32($value = 0, bool $owned = false): CData
    {
        if (\is_iterable($value)) {
            return Type::uint32Array($value, $owned);
        }

        return Type::uint32($value, $owned);
    }
}

if (! function_exists('int64')) {
    /**
     * @param int|int[] $value
     * @param bool $owned
     * @return CData
     */
    function int64($value = 0, bool $owned = false): CData
    {
        if (\is_iterable($value)) {
            return Type::int64Array($value, $owned);
        }

        return Type::int64($value, $owned);
    }
}

if (! function_exists('uint64')) {
    /**
     * @param int|int[] $value
     * @param bool $owned
     * @return CData
     */
    function uint64($value = 0, bool $owned = false): CData
    {
        if (\is_iterable($value)) {
            return Type::uint64Array($value, $owned);
        }

        return Type::uint64($value, $owned);
    }
}

if (! function_exists('float')) {
    /**
     * @param float|float[] $value
     * @param bool $owned
     * @return CData
     */
    function float($value = 0.0, bool $owned = false): CData
    {
        if (\is_iterable($value)) {
            return Type::floatArray($value, $owned);
        }

        return Type::float($value, $owned);
    }
}

if (! function_exists('double')) {
    /**
     * @param float|float[] $value
     * @param bool $owned
     * @return CData
     */
    function double($value = 0.0, bool $owned = false): CData
    {
        if (\is_iterable($value)) {
            return Type::doubleArray($value, $owned);
        }

        return Type::double($value, $owned);
    }
}

if (! function_exists('ldouble')) {
    /**
     * @param float|float[] $value
     * @param bool $owned
     * @return CData
     */
    function ldouble($value = 0.0, bool $owned = false): CData
    {
        if (\is_iterable($value)) {
            return Type::longDoubleArray($value, $owned);
        }

        return Type::longDouble($value, $owned);
    }
}

if (! function_exists('string')) {
    /**
     * @param string|string[] $string
     * @param bool $owned
     * @return CData|string|string[]
     */
    function string($string, bool $owned = false): CData
    {
        if (\is_iterable($string)) {
            return Type::stringArray($string, $owned);
        }

        return Type::string($string, $owned);
    }
}

if (! function_exists('wide_string')) {
    /**
     * @param string|string[] $string
     * @param bool $owned
     * @return CData|string|string[]
     */
    function wide_string($string, bool $owned = false): CData
    {
        if (\is_iterable($string)) {
            return Type::wideStringArray($string, $owned);
        }

        return Type::wideString($string, $owned);
    }
}

if (! function_exists('carray')) {
    /**
     * @param string $type
     * @param iterable $initializer
     * @param bool $owned
     * @return CData
     */
    function carray(string $type, iterable $initializer = [], bool $owned = false): CData
    {
        return Type::array($type, $initializer, $owned);
    }
}
