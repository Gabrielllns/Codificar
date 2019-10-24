<?php

namespace App\Utils;

/**
 * Class Utils.
 *
 * @package App\Utils
 * @author Gabrielllns
 */
class Utils
{

    /**
     * Retorna o valor existente no array ($data) conforme o índice ($index).
     * Obs: Caso o índice não exista o retorno será 'nulo'.
     *
     * @param string $index
     * @param array $data
     * @param mixed $return
     *
     * @return mixed
     */
    public static function getValue($index, $data, $return = null)
    {
        $hasValueValid = isset($index) && isset($data) && array_key_exists($index, $data);

        if (!is_null($return)) {
            $value = $hasValueValid && !is_null($data[$index]) ? $data[$index] : $return;
        } else {
            $value = $hasValueValid ? $data[$index] : $return;
        }

        return $value;
    }

    /**
     * Retorno o valor boolean conforme os parâmetros informados.
     * Obs: Caso o índice não exista o retorno será 'false'.
     *
     * @param $index
     * @param $data
     *
     * @return mixed
     */
    public static function getBooleanValue($index, $data)
    {
        $value = Utils::getValue($index, $data, false);

        if ($value !== false) {
            $value = json_decode($value);
        }

        return $value;
    }

}
