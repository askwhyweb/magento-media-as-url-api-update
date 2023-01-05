<?php
/**
 * Copyright © 2023 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace FiveTech\GalleryImages\Plugin\Magento\Catalog\Model\ProductRepository;

use Magento\Framework\Api\Data\ImageContentInterface;
use Magento\Framework\Api\Data\ImageContentInterfaceFactory;


class MediaGalleryProcessor
{

    public function aroundProcessMediaGallery(\Magento\Catalog\Model\ProductRepository\MediaGalleryProcessor $subject, \Closure $proceed, $product, $mediaGalleryEntries)
    {
        foreach ($mediaGalleryEntries as $k => $entry) {
            if(isset($entry['content']['data'][ImageContentInterface::BASE64_ENCODED_DATA]) && $entry['content']['data'][ImageContentInterface::BASE64_ENCODED_DATA] == ''):
                if (isset($entry['file']) && !empty($entry['file']) && filter_var($entry['file'], FILTER_VALIDATE_URL)):
                    $imagedata = file_get_contents($entry['file']);
                    $base64image = base64_encode($imagedata);
					$filename = basename($entry['file']);
                    $entry['content']['data'][ImageContentInterface::BASE64_ENCODED_DATA] = $base64image;
                    $mediaGalleryEntries[$k]['content']['data'][ImageContentInterface::BASE64_ENCODED_DATA] = $base64image;
                    //$mediaGalleryEntries[$k]['file'] = $filename; // backward compatibility
                endif;
            endif;
        }
        $returnValue = $proceed($product, $mediaGalleryEntries);
        return $returnValue;
    }
}

