<?php
namespace PHPArrayHelpers;

class ArrayHelpers
{
    public static function only(array $values, array $keys): array
    {
        return array_intersect_key($values, array_flip($keys));
    }

    public static function except(array $values, array $keys): array
    {
        return array_diff_key($values, array_flip($keys));
    }

    public static function after(array $array, string $key, array $element): array
    {
        if (!array_key_exists($key, $array)) {
            return $array;
        }

        $keys = array_keys($array);
        $start = (int) array_search($key, $keys, true) + 1; // Offset
        $splicedArray = array_splice($array, $start);
        $elementKey = key($element);
        $array[$elementKey] = $element[$elementKey];
        $result = array_merge($array, $splicedArray);
        return $result;
    }

    public static function bytes(array $array, int $flags = 0): string
    {
        return mb_strlen(json_encode($array, $flags), '8bit');
    }

    public static function format(array $array, string $separator = '', string $format = '%s %s'): string
    {
        return join($separator, array_map(
            fn($key, $value): string => sprintf($format, $key, $value),
            array_keys($array),
            array_values($array)
        ));
    }
}