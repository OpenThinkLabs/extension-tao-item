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
 * Copyright (c) 2015-2020 (original work) Open Assessment Technologies SA (under the project TAO-PRODUCT);
 *
 * @author Mikhail Kamarouski, <kamarouski@1pt.com>
 */

namespace oat\taoItems\model\pack\encoders;

use oat\tao\helpers\Base64;
use oat\tao\model\media\MediaAsset;
use tao_models_classes_FileNotFoundException;
use oat\tao\model\media\sourceStrategy\HttpSource;

/**
 * Class NoneEncoder
 *
 * @package oat\taoItems\model\pack\encoders
 */
class NoneEncoder implements Encoding
{
    /**
     * NoneEncoder constructor.
     */
    public function __construct()
    {
    }


    /**
     * @param mixed $data
     *
     * @throws tao_models_classes_FileNotFoundException
     *
     * @return mixed|string
     */
    public function encode($data)
    {
        if ($data instanceof MediaAsset) {
            $mediaSource = $data->getMediaSource();
            $mediaIdentifier = $data->getMediaIdentifier();

            if ($mediaSource instanceof HttpSource || Base64::isEncodedImage($mediaIdentifier)) {
                return $mediaIdentifier;
            }

            return $mediaSource->getBaseName($mediaIdentifier);
        }

        return $data;
    }
}
