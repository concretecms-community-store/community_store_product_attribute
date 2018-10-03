<?php
defined('C5_EXECUTE') or die("Access Denied."); ?>

<input name="<?=$view->field('value')?>" class="select2-select product-select-<?=$view->attributeKey->getAttributeKeyID()?>" style="width: 100%" placeholder="<?= t('Select Product') ?>" />

<script type="text/javascript">
    $(document).ready(function () {
        $(".product-select-<?=$view->attributeKey->getAttributeKeyID()?>").select2({
            allowClear: true,
            ajax: {
                url: "<?= \URL::to('/productfinder')?>",
                dataType: 'json',
                quietMillis: 250,
                data: function (term, page) {
                    return {
                        q: term // search term
                    };
                },
                results: function (data) {
                    var results = [];
                    $.each(data, function(index, item){
                        results.push({
                            id: item.pID,
                            text: item.name + (item.SKU ? ' (' + item.SKU + ')' : '')
                        });
                    });
                    return {
                        results: results
                    };
                },
                cache: true
            },
            minimumInputLength: 2,
            initSelection: function(element, callback) {
                callback({id: <?= ($pID ? $pID : 0); ?>, text: '<?= ($product ? $product->getName() : '');?>' });
            }
        }).select2('val', []);
    });
</script>