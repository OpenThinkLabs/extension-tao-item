<?php

/**  
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; under version 2
 * of the License (non-upgradable).
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 * 
 * Copyright (c) 2015 (original work) Open Assessment Technologies SA (under the project TAO-PRODUCT);
 * 
 */

namespace oat\taoItems\model\pack;

use \core_kernel_classes_Resource;
use \taoItems_models_classes_ItemsService;
use \common_exception_NoImplementation;
use \ReflectionClass;
use \common_Exception;

/**
 * The Item Pack represents the item package data produced by the compilation.
 *
 * @package taoItems
 * @author Bertrand Chevrier <bertrand@taotesting.com>
 */
class Packer
{

    private $item;
    private $itemService; 

    public function __construct(core_kernel_classes_Resource $item){
        $this->item = $item;
        $this->itemService = taoItems_models_classes_ItemsService::singleton();
    }
    
    private function getItemPacker(){

        $itemModel = $this->itemService->getItemModel($this->item);
        if(is_null($itemModel)){
            throw new common_exception_NoImplementation('No item model for item '.$this->item->getUri());
        }

        $impl = $this->itemService->getItemModelImplementation($itemModel);
        if(is_null($impl)){
            throw new common_exception_NoImplementation('No implementation for model '.$itemModel->getUri());
        }

        $packerClass = new ReflectionClass($impl->getPackerClass());
        if(is_null($packerClass) || !$packerClass->implementsInterface('oat\taoItems\model\pack\Packable')){
            throw new common_exception_NoImplementation('The packer class seems to be not implemented');
        }

        return new $packerClass();
    }

    public function pack(){
        
        try{
            $packer = $this->getItemPacker();
            $itemPack = $packer->packItem($this->item);
        } catch(common_Exception $e){
            throw new common_Exception('The item '. $this->item->getUri() .' cannot be packed : ' . $e->getMessage());
        }

        return $itemPack;
    }
}
?>
