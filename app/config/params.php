<?php

Yii::setAlias('@informacionImgPath', dirname(__DIR__).'/../images/informacion/');
Yii::setAlias('@informacionImgUrl', '/images/informacion');

Yii::setAlias('@estudianteImgPath', dirname(__DIR__).'/../uploads/estudiante/');
Yii::setAlias('@estudianteImgUrl', '/uploads/estudiante');

Yii::setAlias('@images','http://iete.test/images');
Yii::setAlias('@images1','http://api.iete.test/uploads');

return [
    'moneda'=>' Bs.',
    'label_moneda'=>' Bolivianos',
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'soporte@soporte.com',
    'user.passwordResetTokenExpire' => 3600,
    'GOOGLE_API_KEY' => 'AIzaSyBUf2cDjX6QTyLvUYGe5IQs748Sn_UzBKs',
    'map_zoom_one' => '' 
];