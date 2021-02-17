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
 * Util general
 * 
 * @author Máximo Sojo <maxsojo13@gmail.com>
 */
class Tools
{
    /**
     * Protege el número de teléfono con asteriscos
     * @param type $toConvert
     * @return type
     */
    public static function asterisksPhone($toConvert,$callingCode) 
    {
        $lastDigits = 4;
        $mask = $callingCode."-***-***";
        $lengthString = strlen($toConvert);
        $digitsNo = substr($toConvert, ($lengthString-$lastDigits), $lengthString);
        return $mask . $digitsNo;
    }

    /**
     * Protege el email con asteriscos
     * @param type $toConvert
     * @return type
     */
    public static function asterisksEmail($toConvert) 
    {
        $dataConvert = explode("@",$toConvert);
        $lastDigits = 4;
        $mask = "******";
        $lengthString = strlen($dataConvert[0]);
        $digitsNo = substr($dataConvert[0], ($lengthString-$lastDigits), $lengthString);
        return sprintf("%s%s@%s",$mask,$digitsNo,$dataConvert[1]);
    }

    /**
     * Protege la cuenta bancaria con asteriscos
     * @param type $toConvert
     * @return type
     */
    public static function asterisksBankAccount($toConvert) 
    {
        $lastDigits = 6;
        $fistDigits = 4;
        $mask = "-****-**-***";
        $lengthString = strlen($toConvert);
        $postDigits = substr($toConvert, ($lengthString-$lastDigits), $lengthString);
        $preDigits = substr($toConvert, 0, $fistDigits);
        return $preDigits.$mask . $postDigits;
    }
    
    /**
     * Protege la cuenta bancaria con asteriscos
     * @param type $toConvert
     * @return type
     */
    public static function formatBankAccount($toConvert) 
    {
        $toConvert = $toConvert ."";
        $rules = [4,4,2,20];
        $formated = '';
        $start = 0;
        $rulesCount = count($rules);
        $i = 0;
        foreach ($rules as $rule)
        {
            $i++;
            $part = substr($toConvert, $start,$rule);
            $start += $rule;
            
            $formated .= $part;
            if($i < $rulesCount){
                $formated .= '-';
            }
        }
        
        return $formated;
    }
}
