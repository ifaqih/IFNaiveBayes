<?php

namespace Ifaqih\Aimethods;

use Throwable;

if (!defined('NB_BY_ROWS') && !defined('NB_BY_GROUP_LABEL') && !defined('NB_BY_NUMBER')) {
    define('NB_BY_ROWS', 0);
    define('NB_BY_GROUP_LABEL', 1);
    define('NB_BY_NUMBER', 2);
}

class NaiveBayes
{
    protected static $data;
    protected static $training_data;
    protected static $training_type;
    protected static $key_label = 'label';
    protected static $result_point = NULL;
    protected static $result = NULL;

    public static function set_data(array $data): void
    {
        static::$data = $data;
        return;
    }

    public static function set_training_data(array|object $data, int $type_training_data = 0, string $key_label = null): void
    {
        static::$training_data = (array) $data;
        static::$training_type = $type_training_data;
        static::$key_label = !empty($key_label) ? $key_label : static::$key_label;
        return;
    }

    public static function get_result(): string|int|float|null
    {
        return static::$result;
    }

    public static function get_result_point(?string $label = null): object|float|int|null
    {
        $point = !empty(static::$result_point) ? (object) static::$result_point : NULL;
        return empty($label) ? $point : (isset($point->$label) ? $point->$label : NULL);
    }

    public static function process(?array $data = null, array|object|null $training_data = null, int|null $type_training_data = null, ?string $key_label = null, bool $boolean_returned = true, bool $clear_after = false): string|bool|null
    {
        try {

            if (!empty($type_training_data) || !empty(static::$training_type)) {
                static::$training_type = !empty($type_training_data) ? $type_training_data : static::$training_type;
                unset($type_training_data);
            } else {
                $return = NULL;
            }

            if (!empty(static::$result_point) && !empty(static::$result)) {
                return $boolean_returned ? TRUE : static::$result;
            }

            if (static::$training_type !== 2) {
                if (!empty($data) || !empty(static::$data)) {
                    static::$data = !empty($data) ? $data : static::$data;
                    unset($data);
                } else {
                    $return = NULL;
                }
            } else {
                static::$data = [];
            }

            if (!empty($key_label) || !empty(static::$key_label)) {
                static::$key_label = !empty($key_label) ? $key_label : static::$key_label;
                unset($key_label);
            } else {
                $return = NULL;
            }

            if (!empty($training_data) || !empty(static::$training_data)) {
                static::$training_data = !empty($training_data) ? $training_data : static::$training_data;
                unset($training_data);
            } else {
                $return = NULL;
            }

            if (!isset($return)) {
                if (((static::$training_type !== 2 && count(static::$data) > 0) || (static::$training_type == 2 && count(static::$data) == 0)) && (count((array) static::$training_data) > 0)) {
                    if (in_array(static::$training_type, [0, 1, 2])) {
                        $nb = self::nb(static::$data, static::$training_type);
                        if ($clear_after) {
                            self::clear();
                        } else {
                            static::$result_point = $nb['point'];
                            static::$result = $nb['result'];
                        }
                        $return = $boolean_returned ? !empty($nb['result']) : $nb['result'];
                    } else {
                        $return = NULL;
                    }
                } else {
                    $return = NULL;
                }
            } else {
                self::clear();
            }

            return $return;
        } catch (Throwable $e) {
            echo $e->getMessage();
            die();
        }
    }

    private static function nb(array $data, int $training_type): array
    {
        $sample = [];
        $b = [];
        $n_label = [];
        $name_atribut = (count(static::$data) > 0) ? array_keys($data) : [];

        switch ($training_type) {
            case 0:
                $c_training = count(static::$training_data);
                $c_label = array_count_values(array_column(static::$training_data, static::$key_label));

                foreach (static::$training_data as $key => $value) {
                    $value = (array) $value;
                    foreach ($name_atribut as $ke => $val) {
                        if (isset($data[$val]) && isset($value[$val])) {
                            if ($data[$val] == $value[$val]) {
                                $sample[$value[static::$key_label]][$val] = isset($sample[$value[static::$key_label]][$val]) ? $sample[$value[static::$key_label]][$val] + 1 : 1;
                            }
                        }
                    }
                }
                break;
            case 1:
                foreach (static::$training_data as $key => $value) {
                    $c_label[$key] = count($value);
                    foreach ($name_atribut as $k => $v) {
                        $cv = array_count_values(array_column($value, $v));
                        $sample[$key][$v] = isset($cv[$data[$v]]) ? $cv[$data[$v]] : 0;
                    }
                }
                $c_training = array_sum($c_label);
                break;
            case 2:
                foreach (static::$training_data as $key => $value) {
                    $value = (array) $value;
                    $c_label[$key] = $value['total'];
                    $sample[$key] = $value['attributes'];
                    $atribut_key = array_keys($value['attributes']);
                    $name_atribut = (count($name_atribut) < count($atribut_key)) ? $atribut_key : $name_atribut;
                }
                $c_training = array_sum($c_label);
                break;
            default:
                return [
                    "result"    =>  NULL,
                    "point"     =>  NULL
                ];
                break;
        }
        foreach (array_keys($c_label) as $key => $value) {
            if (isset($sample[$value])) {
                foreach ($name_atribut as $k => $v) {
                    $b[$value][$v] = isset($sample[$value][$v]) ? ($sample[$value][$v] / $c_label[$value]) : 0;
                }
                $n_label[$value] = array_product($b[$value]) * ($c_label[$value] / $c_training);
            } else {
                $n_label[$value] = 0;
            }
        }

        static::$training_data = NULL;
        static::$data = NULL;

        $p_label = $n_label;
        arsort($n_label, SORT_NUMERIC);

        return [
            "result"    =>  array_key_first($n_label),
            "point"     =>  $p_label
        ];
    }

    public static function clear(): void
    {
        static::$key_label = 'label';
        static::$training_type = NULL;
        static::$training_data = NULL;
        static::$result_point = NULL;
        static::$result = NULL;
        return;
    }
}
