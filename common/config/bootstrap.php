<?php
date_default_timezone_set('Asia/Calcutta');
$WebProtocol=$_SERVER['PROTOCOL'] = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https' : 'http';
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@storage', dirname(dirname(__DIR__)) . '/storage');
Yii::setAlias('@frontendUrl', $WebProtocol."://".$_SERVER['SERVER_NAME']);
Yii::setAlias('@backendUrl', $WebProtocol."://".$_SERVER['SERVER_NAME']."/backend");
Yii::setAlias('@storageUrl',$WebProtocol."://".$_SERVER['SERVER_NAME']."/storage");
Yii::setAlias('@storageUrlNonProtocal',"//".$_SERVER['SERVER_NAME']."/storage");

Yii::setAlias('@AllowedCountry',"IN");
Yii::setAlias('@currency',"₹");
Yii::setAlias('@currencyCode',"INR");

//Paynimo
Yii::setAlias('@MerchantCode','L607750');
Yii::setAlias('@MerchantKey','8161669614SCVHXL');
Yii::setAlias('@MerchantIV','1128771390EHJXXQ');
Yii::setAlias('@MerchantBankCode','1500');





