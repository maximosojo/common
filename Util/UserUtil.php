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

use Maxtoan\Common\Util\StringUtil;

/**
 * Util basico usuarios
 * 
 * @author Máximo Sojo <maxsojo13@gmail.com>
 */
class UserUtil
{
    /**
     * Usuario normalizado para crear por la aplicacion: ejemplo.231_abz
     */
    const EXP_USERNAME_CREATE = '/[^a-z0-9\_.]/';

    /**
     * Usuario normalizado con caja, incluye el caracter -
     */
    const EXP_USERNAME = '/[^a-z0-9\_.\-]/';

    /**
     * Nombre de usuario valido @ejemplo.231-abZ
     */
    const EXP_VALID_USERNAME = '/[^a-z0-9\_.\-@]/';

    /**
     * Genera una contrase;a
     * @return string
     */
    public static function generatePassword()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 30; $i++) {
            $randstring = $characters[rand(0, strlen($characters - 1))];
        }
        return $randstring;
    }

    /**
     * Normaliza un nombre de usuario, elimina el @ de la cadena
     * @example @inhack20 lo transforma a inhack20
     * @param type $str
     * @return type
     */
    public static function normalizeUsername($str,$forReceiver = false)
    {
        $str = mb_strtolower($str);
        $exp = self::EXP_USERNAME_CREATE;
        if($forReceiver === true){
            $exp = self::EXP_USERNAME;
        }
        return StringUtil::clean($str,$exp);
    }
    
    /**
     * Parsea un nombre de usuario para mostrarlo, le agrega el @ al inicio
     * @example inhack20 lo transforma a @inhack20
     * @param type $str
     */
    public static function parseUsername($str)
    {
         $str = self::normalizeUsername($str);
         return "@".$str;
    }

    /**
     * Formatea un número de teléfono de acuerdo al pais
     * @param type $nroPhone
     * @param type $country
     * @return string|null
     */
    public static function formatPhoneNumber($nroPhone,$country,$types = null)
    {
        $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
        if(!$types) {
            $types = [\libphonenumber\PhoneNumberType::MOBILE];
        }
        try {
            $swissNumberProto = $phoneUtil->parse($nroPhone,$country);
            if($phoneUtil->isValidNumber($swissNumberProto) &&  in_array($phoneUtil->getNumberType($swissNumberProto),$types) ){
                $nroPhone = $swissNumberProto->getCountryCode().$swissNumberProto->getNationalNumber();
                $carrierMapper = \libphonenumber\PhoneNumberToCarrierMapper::getInstance();
                $carrier = $carrierMapper->getNameForNumber($swissNumberProto, "en");
                if($phoneUtil->getNumberType($swissNumberProto) == \libphonenumber\PhoneNumberType::MOBILE) {
                    if(empty($carrier)){
                        $nroPhone = null;
                    }
                }
            }else {
                $nroPhone = null;
            }
        } catch (\libphonenumber\NumberParseException $e) {
            $nroPhone = null;
        }

        return $nroPhone;
    }
}
