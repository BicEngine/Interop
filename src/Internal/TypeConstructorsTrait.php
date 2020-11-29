<?php

/**
 * This file is part of Interop package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Interop\Internal;

use FFI\CData;

/**
 * @internal TypeConstructorsTrait is an internal library trait, please do not use it in your code.
 * @psalm-internal Bic\Interop
 */
trait TypeConstructorsTrait
{
    /**
     * @param string $type
     * @param iterable $initializer
     * @param bool $owned
     * @return CData
     */
    public static function array(string $type, iterable $initializer = [], bool $owned = true): CData
    {
        $initializer = $initializer instanceof \Traversable
            ? \iterator_to_array($initializer, false)
            : [...$initializer]
        ;

        $instance = \FFI::new($type . '[' . count($initializer) . ']', $owned);

        foreach ($initializer as $i => $value) {
            $instance[$i] = $value;
        }

        return $instance;
    }

    /**
     * @param string $type
     * @param mixed $value
     * @param bool $owned
     * @return CData
     */
    public static function scalar(string $type, $value, bool $owned = true): CData
    {
        $instance = \FFI::new($type, $owned);
        $instance->cdata = $value;

        return $instance;
    }

    /**
     * @param int|int[] $value
     * @param bool $owned
     * @return CData
     */
    public static function int8($value = 0, bool $owned = true): CData
    {
        if (\is_iterable($value)) {
            return self::array('int8_t', $value, $owned);
        }

        return self::scalar('int8_t', $value, $owned);
    }

    /**
     * @param int|int[] $value
     * @param bool $owned
     * @return CData
     */
    public static function uint8($value = 0, bool $owned = true): CData
    {
        if (\is_iterable($value)) {
            return self::array('uint8_t', $value, $owned);
        }

        return self::scalar('uint8_t', $value, $owned);
    }

    /**
     * @param int|int[] $value
     * @param bool $owned
     * @return CData
     */
    public static function int16($value = 0, bool $owned = true): CData
    {
        if (\is_iterable($value)) {
            return self::array('int16_t', $value, $owned);
        }

        return self::scalar('int16_t', $value, $owned);
    }

    /**
     * @param int|int[] $value
     * @param bool $owned
     * @return CData
     */
    public static function uint16($value = 0, bool $owned = true): CData
    {
        if (\is_iterable($value)) {
            return self::array('uint16_t', $value, $owned);
        }

        return self::scalar('uint16_t', $value, $owned);
    }

    /**
     * @param int|int[] $value
     * @param bool $owned
     * @return CData
     */
    public static function int32($value = 0, bool $owned = true): CData
    {
        if (\is_iterable($value)) {
            return self::array('int32_t', $value, $owned);
        }

        return self::scalar('int32_t', $value, $owned);
    }

    /**
     * @param int|int[] $value
     * @param bool $owned
     * @return CData
     */
    public static function uint32($value = 0, bool $owned = true): CData
    {
        if (\is_iterable($value)) {
            return self::array('uint32_t', $value, $owned);
        }

        return self::scalar('uint32_t', $value, $owned);
    }

    /**
     * @param int|int[] $value
     * @param bool $owned
     * @return CData
     */
    public static function int64($value = 0, bool $owned = true): CData
    {
        if (\is_iterable($value)) {
            return self::array('int64_t', $value, $owned);
        }

        return self::scalar('int64_t', $value, $owned);
    }

    /**
     * @param int|int[] $value
     * @param bool $owned
     * @return CData
     */
    public static function uint64($value = 0, bool $owned = true): CData
    {
        if (\is_iterable($value)) {
            return self::array('uint64_t', $value, $owned);
        }

        return self::scalar('uint64_t', $value, $owned);
    }

    /**
     * @param float|float[] $value
     * @param bool $owned
     * @return CData
     */
    public static function float($value = 0.0, bool $owned = true): CData
    {
        if (\is_iterable($value)) {
            return self::array('float', $value, $owned);
        }

        return self::scalar('float', $value, $owned);
    }

    /**
     * @param float|float[] $value
     * @param bool $owned
     * @return CData
     */
    public static function double($value = 0.0, bool $owned = true): CData
    {
        if (\is_iterable($value)) {
            return self::array('double', $value, $owned);
        }

        return self::scalar('double', $value, $owned);
    }

    /**
     * @param float|float[] $value
     * @param bool $owned
     * @return CData
     */
    public static function longDouble($value = 0.0, bool $owned = true): CData
    {
        if (\is_iterable($value)) {
            return self::array('long double', $value, $owned);
        }

        return self::scalar('long double', $value, $owned);
    }


    /**
     * @param bool|bool[] $value
     * @param bool $owned
     * @return CData
     */
    public static function bool($value = true, bool $owned = true): CData
    {
        if (\is_iterable($value)) {
            return self::array('bool', $value, $owned);
        }

        return self::scalar('bool', $value, $owned);
    }

    /**
     * @param string|string[]|int $stringOrLength
     * @param bool $wideChar
     * @param bool $owned
     * @return CData|string|string[]
     */
    public static function string($stringOrLength, bool $wideChar = true, bool $owned = true): CData
    {
        if (\is_iterable($stringOrLength)) {
            $result = [];

            foreach ($stringOrLength as $item) {
                $result[] = self::string($item, $wideChar, false);
            }

            return self::array('char *', $result);
        }

        if (\is_int($stringOrLength)) {
            return \FFI::new("char[$stringOrLength]", $owned);
        }

        $length = \strlen($nullTerminated = $stringOrLength . ($wideChar ? "\0\0" : "\0"));

        $instance = \FFI::new("char[$length]", $owned);

        \FFI::memcpy($instance, $nullTerminated, $length);

        return $instance;
    }
}
