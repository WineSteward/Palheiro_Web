<?php

namespace common\helpers;

class UrlHelper
{
    /**
     * Generate image URL.
     * 
     * @param string $imageName The name of the image.
     * @return string The complete image URL.
     */
    public static function getImageUrl($imageName)
    {
        return \Yii::$app->getRequest()->getHostInfo() 
            . '/palheiro/backend/web/index.php?r=image/get&imageName=' . urlencode($imageName);
    }
}
