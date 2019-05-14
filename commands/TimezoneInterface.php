<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\web\Controller;
use yii\console\ExitCode;
use Yii;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
interface TimezoneInterface
{
    public function TimeZoneUserRegisterAndSettings();

    public function IpAdresUserTimeZone();

}
/*public function AutTimeZoneRegister()
{
    $data=$this->IpAdresUser();
    $time= $data['region']['timezone'];
    return date_default_timezone_set($time);
}

public function IpAdresUser()
{
    $ip = Yii::$app->request->userIP;
    return $ip;
}*/