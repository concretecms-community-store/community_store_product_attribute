<?php
namespace Concrete\Package\CommunityStoreProductAttribute;

use Concrete\Core\Package\Package;

class Controller extends Package
{
    protected $pkgHandle = 'community_store_product_attribute';
    protected $appVersionRequired = '8.0';
    protected $pkgVersion = '0.5';
    protected $packageDependencies = ['community_store'=>'2.0'];

    public function getPackageDescription()
    {
        return t("Community Store Product Attribute");
    }

    public function getPackageName()
    {
        return t("Community Store Product Attribute");
    }

    public function install()
    {
        $pkg = parent::install();
        $factory = $this->app->make('Concrete\Core\Attribute\TypeFactory');
        $type = $factory->getByHandle('community_store_product');
        if (!is_object($type)) {
            $type = $factory->add('community_store_product', 'Product', $pkg);
        }
    }
}
