<?php

/*
 * This file is part of the Maxtoan Tools package.
 * 
 * (c) https://maxtoan.github.io/common
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Maxtoan\Common\Util;

/**
 * TokenGenerator
 * 
 * @author Máximo Sojo <maxsojo13@gmail.com>
 */
class TokenGenerator
{
    /**
     * Generador de token
     * 
     * @author Máximo Sojo <maxsojo13@gmail.com>
     * @return Token
     */
    public function generateToken()
    {
        return rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
    }
}
