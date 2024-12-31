<?php

namespace common\helpers;

use yii\helpers\Url;

class UrlHelper
{
    /**
     * Generate image URL for the company folder.
     * 
     * @param string $imageName The name of the image.
     * @return string The complete image URL.
     */
    public static function getCompanyImageUrl($imageName)
    {
        return \Yii::$app->getRequest()->getHostInfo() . Url::to('@companyImages') . '?imageName=' . urlencode($imageName);
    }

   /**
     * Generate image URL for the products folder.
     * 
     * @param string $imageName The name of the image.
     * @return string The complete image URL.
     */
    public static function getProductImageUrl($imageName)
    {
        return \Yii::$app->getRequest()->getHostInfo() . Url::to('@productImages') . '?imageName=' . urlencode($imageName);
    }
}
