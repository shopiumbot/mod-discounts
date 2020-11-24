<?php

namespace shopium\mod\discounts;

use shopium\mod\discounts\models\Discount;
use Yii;
use yii\base\BootstrapInterface;
use core\components\WebModule;
use panix\mod\admin\widgets\sidebar\BackendNav;
use yii\web\GroupUrlRule;

class Module extends WebModule implements BootstrapInterface
{

    public $icon = 'discount';

    /**
     * @var null
     */
    public $discounts = null;
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        if ($this->discounts === null) {

            $this->discounts = Discount::find()
                ->published()
                ->applyDate()
                ->all();
        }
        $groupUrlRule = new GroupUrlRule([
            'prefix' => $this->id,
            'rules' => [
                ''=> 'default/index',
                '<controller:[0-9a-zA-Z_\-]+>'=> '<controller>/index',
                '<controller:[0-9a-zA-Z_\-]+>/<action:[0-9a-zA-Z_\-]+>'=> '<controller>/<action>',
            ],
        ]);
        $app->getUrlManager()->addRules($groupUrlRule->rules, true);
    }

    public function getInfo()
    {
        return [
            'label' => Yii::t('discounts/default', 'MODULE_NAME'),
            'author' => 'andrew.panix@gmail.com',
            'version' => '1.0',
            'icon' => $this->icon,
            'description' => Yii::t('discounts/default', 'MODULE_DESC'),
            'url' => ['/admin/discounts/default/index'],
        ];
    }

    public function getAdminSidebar()
    {
        return (new BackendNav())->findMenu('shop')['items'];
    }

    public function getAdminMenu()
    {
        return [
            'shop' => [
                'items' => [
                    [
                        'label' => Yii::t('discounts/default', 'MODULE_NAME'),
                        'url' => ['/admin/discounts/default/index'],
                        'icon' => $this->icon,
                    ],
                ],
            ],
        ];
    }

}
