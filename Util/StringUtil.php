<?php

/*
 * This file is part of the Máximo Sojo - maxtoan package.
 * 
 * (c) https://maxtoan.github.io/common
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Maxtoan\Common\Util;

/**
 * Util basico en base a Strings de PHP http://php.net/manual/es/book.strings.php
 * 
 * @author Máximo Sojo <maxsojo13@gmail.com>
 */
class StringUtil
{
    /**
     * Escala por defecto para formatear a decimales
     */
    const SCALE_DECIMAL = 2;
    
    /**
     * Formatear un número con los millares agrupados y valores por defecto
     * @author Máximo Sojo <maxsojo13@gmail.com>
     * @param $number
     * @param int $decimals [Número de puntos decimales.]
     * @param string $dec_point [Separador para los decimales.]
     * @param string $thousands_sep [Separador para los millares.]
     * @return number_format
     */
    public static function numberFormat($number, $decimals = self::SCALE_DECIMAL, $dec_point = "," , $thousands_sep = ".")
    {
        $number = number_format($number,$decimals,$dec_point,$thousands_sep);

        return $number;
    }

    /**
     * Generar un id
     * 
     * @author Carlos Mendoza <inhack20@gmail.com>
     * @return id
     */
    public static function getId() 
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 20; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return md5(time() . $randomString);
    }
}
