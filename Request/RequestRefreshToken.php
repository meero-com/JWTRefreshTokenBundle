<?php

/*
 * This file is part of the GesdinetJWTRefreshTokenBundle package.
 *
 * (c) Gesdinet <http://www.gesdinet.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gesdinet\JWTRefreshTokenBundle\Request;

use Symfony\Component\HttpFoundation\Request;

class RequestRefreshToken
{
    public static function getRefreshToken(Request $request, $tokenParameterName)
    {
        $refreshTokenString = null;
        if (false !== strpos($request->getContentType(), 'json')) {
            $content = $request->getContent();
            $params = !empty($content) ? json_decode($content, true) : array();
            $refreshTokenString = $params[$tokenParameterName] ?? $params['refresh_token'] ?? null;
            dump($refreshTokenString);
        } elseif (null !== $request->get($tokenParameterName)) {
            $refreshTokenString = $request->get($tokenParameterName);
        } elseif (null !== $request->get('refresh_token')) {
            $refreshTokenString = $request->get('refresh_token');
        }

        return $refreshTokenString;
    }
}
