<?php
namespace Concrete\Package\CommunityStoreProductAttribute\Attribute\CommunityStoreProduct;

use Concrete\Package\CommunityStore\Src\CommunityStore\Product\Product as StoreProduct;
use Concrete\Core\Attribute\FontAwesomeIconFormatter;

class Controller extends \Concrete\Attribute\Number\Controller
{
    public function form()
    {
        $this->requireAsset('css', 'select2');
        $this->requireAsset('javascript', 'select2');

        if (is_object($this->attributeValue)) {
            $value = $this->attributeValue->getValue();

            $this->set('pID', $value);
            $this->set('product', StoreProduct::getByID($value));
        }
    }

    public function getObjectValue()
    {
        $value = $this->attributeValue->getValueObject();
        if ($value) {
            $product =  StoreProduct::getByID($value->getValue());
            if ($product) {
                return $product;
            }
        }
        return false;
    }

    public function getIconFormatter()
    {
        return new FontAwesomeIconFormatter('gift');
    }

}