<?php

/**
 * Class Dictionary
 */
trait Dictionary
{
    /**
     * @return array
     *
     * Example:
     * ```
     * [
     *     10 => 'active',
     * ]
     * ```
     */
    public static function list(): array
    {
        $reflection = new \ReflectionClass(static::class);
        $constants = array_flip($reflection->getConstants());
        array_walk($constants, function (&$value) {
            $value = str_replace('_', ' ', strtolower($value));
        });
        return $constants;
    }

    /**
     * @param int $id
     * @return null|string
     */
    public static function name(int $id): ?string
    {
        return static::list()[$id] ?? null;
    }

    /**
     * @param string $name
     * @return int|null
     */
    public static function value(string $name): ?int
    {
        return array_flip(static::list())[$name] ?? null;
    }

    /**
     * @return array
     */
    public static function values(): array
    {
        return array_keys(static::list());
    }
}
