<?php
namespace Concrete\Package\CommunityStoreProductAttribute;

use Concrete\Core\Package\Package;
use Whoops\Exception\ErrorException;

class Controller extends Package
{
    protected $pkgHandle = 'community_store_product_attribute';
    protected $appVersionRequired = '8.0';
    protected $pkgVersion = '0.5';

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
        $installed = $this->app->make('Concrete\Core\Package\PackageService')->getInstalledHandles();
        if(!(is_array($installed) && in_array('community_store',$installed)) ) {
            throw new ErrorException(t('This package requires that Community Store be installed'));
        } else {
            $pkg = parent::install();
            $factory = $this->app->make('Concrete\Core\Attribute\TypeFactory');
            $type = $factory->getByHandle('community_store_product');
            if (!is_object($type)) {
                $type = $factory->add('community_store_product', 'Product', $pkg);
            }
        }

    }
}