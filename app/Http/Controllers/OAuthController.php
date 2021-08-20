<?php

namespace App\Http\Controllers;

use Zx\OAuth\OAuthException;
use Zx\OAuth\Wechat\Config AS WxConfig;
use Zx\OAuth\Wechat\OAuth AS WxOAuth;

class OAuthController
{
    public function wx()
    {
        $config = new WxConfig();
        $config->setAppId('wxbdc5610cc59c1631');
        $config->setState('state');
        $config->setRedirectUri('https://hoolai.local/oauth/callback');

        $oauth = new WxOAuth($config);
        $url = $oauth->getAuthUrl();

        header("Location: $url");
        exit();
    }

    public function callback()
    {
        $params = $this->request()->getQueryParams();

        $config = new WxConfig();
        $config->setAppId('appid');
        $config->setSecret('secret');

        $oauth = new WxOAuth($config);
        try {
            $accessToken = $oauth->getAccessToken('state', $params['state'], $params['code']);

            $refreshToken = $oauth->getAccessTokenResult()['refresh_token'];

            $userInfo = $oauth->getUserInfo($accessToken);
            var_dump($userInfo);

            if (!$oauth->validateAccessToken($accessToken)) echo 'access_token 验证失败！' . PHP_EOL;


            if (!$oauth->refreshToken($refreshToken)) echo 'access_token 续期失败！' . PHP_EOL;
        } catch (OAuthException $e) {
        }
    }
}
