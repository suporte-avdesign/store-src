<?php

namespace AVD\Http\Controllers\Web;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use AVD\Http\Controllers\Controller;

use AVD\Interfaces\Web\ProductInterface as InterModel;
use AVD\Interfaces\Web\SectionInterface as InterSection;
use AVD\Interfaces\Web\ConfigSiteInterface as ConfigSite;
use AVD\Interfaces\Web\SocialShareInterface as InterSocial;
use AVD\Interfaces\Web\ConfigProductInterface as ConfigProduct;
use AVD\Interfaces\Web\ConfigKeywordInterface as ConfigKeyword;
use AVD\Interfaces\Web\ConfigColorPositionInterface as ConfigImages;


class ProductController extends Controller
{
    private $phatFiles;

    public function __construct(
        ConfigSite $configSite,
        InterModel $interModel,
        InterSocial $interSocial,
        InterSection $interSection,
        ConfigImages $configImages,
        ConfigKeyword $configKeyword,
        ConfigProduct $configProduct)
    {
        $this->phatFiles     = env('APP_PANEL_URL');
        $this->configSite    = $configSite->setId(1);
        $this->interModel    = $interModel;
        $this->interSocial   = $interSocial;
        $this->interSection  = $interSection;
        $this->configImages  = $configImages;
        $this->configKeyword = $configKeyword->random();
        $this->configProduct = $configProduct->setId(1);

    }


    public function show(Request $request)
    {
        $dataForm = $request->all();
        $product  = $this->interModel->getId($dataForm['id']);
        $section  = $product->section()->first();
        $category = $product->category()->first();
        $colors   = $product->images;
        $social   = $this->interSocial->getAll();
        $configSite    = $this->configSite;
        $configProduct = $this->configProduct;

        $path = $this->getPhatImages($this->phatFiles);

        foreach ($product->prices as $value) {
            if ($value->profile == $configProduct->price_default) {
                $price = $value->price_cash;
                $regular_price = $value->price_card;

                if ($product->offer == 1) {
                    $price_cash = $value->price_cash;
                    $offer_cash = $value->offer_cash;
                }
            }
        }

        $i=1;
        foreach ($colors as $color) {

            if ($i == 1) {
                $data = $color;
            }

            foreach ($color->grids as $item) {
                if ($product->kit == 1){
                    $pa_color = Str::slug($color->color).'|'.$item->id;
                    $pa_size = $item->units.Str::slug($product->measure);
                } else {
                    $pa_color = Str::slug($color->color);
                    $pa_size = $item->grid;
                }

                $attributes[] = $this->getAttributes($pa_color, $pa_size, $price, $regular_price, $product, $path, $color, $item);
            }
           $i++;
        }

        $product_variations = json_encode($attributes);


        return view('frontend.products.quick-view.quick-view-1', compact(
            'product_variations',
                'configProduct',
                'configSite',
                'attributes',
                'category',
                'section',
                'product',
                'social',
                'colors',
                'data',
                'path'
        ));
    }


    /**
     * Date: 06/29/2019
     *
     * @param $pa_color
     * @param $pa_size
     * @param $price
     * @param $regular_price
     * @param $product
     * @param $path
     * @param $color
     * @param $item
     * @return array
     */
    public function getAttributes($pa_color, $pa_size, $price, $regular_price, $product, $path, $color, $item)
    {
        $out = array(
            "attributes" => array(
                "attribute_pa_color" => $pa_color,
                "attribute_pa_size" => $pa_size
            ),
            "availability_html" => "",
            "backorders_allowed" => false,
            "dimensions" => array(
                "length" => "",
                "width" => "",
                "height" => ""
            ),
            "dimensions_html" => "N/A",
            "display_price" => (int) $price,
            "display_regular_price" => (int) $regular_price,
            "image" => array(
                "title" => $product->name,
                "caption" => "",
                "url" => asset($path['G'].$color->image),
                "alt" => "",
                "src" => asset($path['G'].$color->image),
                "srcset" => asset($path['Z'].$color->image) . " 1000w, " . asset($path['G'].$color->image) . " 800w, " . asset($path['N'].$color->image) . " 370w, " . asset($path['T'].$color->image) . " 100w",
                "sizes" => "(max-width => 870px) 100vw, 870px",
                "full_src" => asset($path['Z'].$color->image),
                "full_src_w" => 1000,
                "full_src_h" => 1000,
                "gallery_thumbnail_src" => asset($path['T'].$color->image),
                "gallery_thumbnail_src_w" => 800,
                "gallery_thumbnail_src_h" => 800,
                "thumb_src" => asset($path['N'].$color->image),
                "thumb_src_w" => 370,
                "thumb_src_h" => 370,
                "src_w" => 800,
                "src_h" => 800
            ),
            "image_id" => "{$color->id}",
            "is_downloadable" => false,
            "is_in_stock" => true,
            "is_purchasable" => true,
            "is_sold_individually" => "no",
            "is_virtual" => false,
            "max_qty" => $item->stock,
            "min_qty" => 1,
            "price_html" => "",
            "sku" => "",
            "variation_description" => "",
            "variation_id" => $item->id,
            "variation_is_active" => true,
            "variation_is_visible" => true,
            "weight" => "",
            "weight_html" => "N/A"
        );

        return $out;

    }


    /**
     * Date: 07/01/2019
     *
     * @param $url
     * @return mixed
     */
    public function getPhatImages($url)
    {
        $paths = $this->configImages->getAll();
        foreach ($paths as $value) {
            if ($value->default == 'T') {
                $path['T'] = $url.$value->path;
            } else if($value->default == 'N') {
                $path['N'] = $url.$value->path;
            } else if($value->default == 'G') {
                $path['G'] = $url.$value->path;
            } else if($value->default == 'Z') {
                $path['Z'] = $url.$value->path;
            }
        }

        return $path;
    }
}
