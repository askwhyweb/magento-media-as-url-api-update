# Mage2 Module FiveTech GalleryImages

    `fivetech/module-galleryimages`

 - [Main Functionalities](#main-functionalities)
 - [Installation](#installation)
 - [Specifications](#specifications)
 - [How to use](#how-to-use)

## Main Functionalities
Gallery Images update using URL.

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/FiveTech`
 - Enable the module by running `php bin/magento module:enable FiveTech_GalleryImages`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require fivetech/module-galleryimages`
 - enable the module by running `php bin/magento module:enable FiveTech_GalleryImages`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Specifications

 - Plugin
	- aroundProcessMediaGallery - Magento\Catalog\Model\ProductRepository\MediaGalleryProcessor > FiveTech\GalleryImages\Plugin\Magento\Catalog\Model\ProductRepository\MediaGalleryProcessor

## How to use

PUT Request to URL: `{site-url}/rest/V1/products/{your-product-sku}`

Body Request: 
```json
{
    "product": {
        "sku": "{your-product-sku}",
        "mediaGalleryEntries": [
            {
                "mediaType": "image",
                "label": "Test Product Image",
                "position": 1,
                "disabled": false,
                "file": "{your-url-to-image}", // https://d3708nxi8xs1qx.cloudfront.net/Image1.png
                "types": [
                    "image",
                    "thumbnail",
                    "small_image"
                ],
                "content": {
                    "base64EncodedData": "",
                    "type": "image/png", // keep it as per format e.g. png
                    "name": "desired_filename.png" // your-desired-filename
                }
            }
        ]
    }
}
```