<?php

namespace AVD\Http\Controllers\Web;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use AVD\Http\Controllers\Controller;

use AVD\Interfaces\Web\SectionInterface as InterSection;
use AVD\Interfaces\Web\ConfigSiteInterface as ConfigSite;
use AVD\Interfaces\Web\ImageColorInterface as InterModel;
use AVD\Interfaces\Web\SocialShareInterface as InterSocial;
use AVD\Interfaces\Web\ConfigProductInterface as ConfigProduct;
use AVD\Interfaces\Web\ConfigKeywordInterface as ConfigKeyword;
use AVD\Interfaces\Web\ConfigColorPositionInterface as ConfigImages;


class ImageColorController extends Controller
{


    public function __construct(
        ConfigSite $configSite,
        InterModel $interModel,
        InterSocial $interSocial,
        InterSection $interSection,
        ConfigImages $configImages,
        ConfigKeyword $configKeyword,
        ConfigProduct $configProduct)
    {

        $this->configSite    = $configSite->setId(1);
        $this->interModel    = $interModel;
        $this->interSocial   = $interSocial;
        $this->interSection  = $interSection;
        $this->configImages  = $configImages;
        $this->configKeyword = $configKeyword->random();
        $this->configProduct = $configProduct->setId(1);
    }


    /**
     * Date: 06/29/2019
     *
     * @param $slug
     * @return View
     */
    public function index($slug)
    {
        $url = env('APP_PANEL_URL');
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

        $menu          = $this->interSection->getMenu();
        $social        = $this->interSocial->getAll();
        $configSite    = $this->configSite;
        $configProduct = $this->configProduct;
        $configKeyword = $this->configKeyword;

        $data     = $this->interModel->get($slug);
        $section  = $data->product->section()->first();
        $category = $data->product->category()->first();
        $product  = $data->product()->first();
        $colors   = $product->images;
        $offer_cash = '';
        $price_cash = '';
        foreach ($data->product->prices as $value) {
            if ($value->profile == $configProduct->price_default) {
                $price = $value->price_cash;
                $regular_price = $value->price_card;

                if ($product->offer == 1) {
                    $price_cash = $value->price_cash;
                    $offer_cash = $value->offer_cash;
                }
            }
        }

        foreach ($colors as $color) {
            foreach ($color->grids as $item) {
                if ($product->kit == 1){
                    $pa_color = Str::slug($color->color).'|'.$item->id;
                    $pa_size = $item->units.Str::slug($product->measure);
                } else {
                    $pa_color = Str::slug($color->color);
                    $pa_size = $item->grid;
                }

                $attributes[] = $this->getAttributes($pa_color, $pa_size, $price, $regular_price, $data, $path, $color, $item);
            }
        }

        $product_variations = json_encode($attributes);
        $schema_org = array(
            "@context" => "https://schema.org/",
            "@graph" => $this->schemaOrg($data, $section, $category, $product, $path, $offer_cash)
        );

        return view('frontend.products.product-1', compact(
            'product_variations',
            'configKeyword',
            'configProduct',
            'schema_org',
            'configSite',
            'attributes',
            'category',
            'section',
            'product',
            'social',
            'colors',
            'data',
            'path',
            'menu'
        ));

    }



    public function search(Request $request)
    {
        $post_type = $request['post_type'];
        $action = $request['action'];
        $number = $request['number'];
        $search = $request['query'];

        $path        = env('APP_PANEL_URL');
        $configImage = $this->configImages->setName('default', 'N');
        $photoUrl    = $path.$configImage->path;

        $configProduct = $this->configProduct;






        if (strlen($search) >= 3) {

            $results = $this->interModel->search($search);
            if (count($results) >= 1) {
                foreach ($results as $result) {

                    $product = $result->product;

                    foreach($product->prices as $price) {
                        if ($product->offer == 1) {
                            if ($price->profile == $configProduct->price_default) {
                                $price_cash_percent = floatval($price->price_cash_percent);
                                $price_card_percent = floatval($price->price_card_percent);
                                $profile_default_name = $price->profile;
                                $price_default_cash = setReal($price->offer_cash);
                                $price_default_card = setReal($price->offer_card);
                            } else {
                                $price_cash_percent = floatval($price->price_cash_percent);
                                $price_card_percent = floatval($price->price_card_percent);
                                $profile_other_name = $price->profile;
                                $price_other_cash = setReal($price->offer_cash);
                                $price_other_card = setReal($price->offer_card);
                            }
                        } else {
                            if ($price->profile == $configProduct->price_default) {
                                $profile_default_name = $price->profile;
                                $price_default_cash = setReal($price->price_cash);
                                $price_default_card = setReal($price->price_card);
                            } else {
                                $profile_other_name = $price->profile;
                                $price_other_cash = setReal($price->price_cash);
                                $price_other_card = setReal($price->price_card);
                            }
                        }
                    }

                    $suggestions[] = array(
                        "value" => $product->name,
                        "permalink" => url(setRoute('color').$result->slug),
                        "price" => '<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$ </span>'.$price_other_card.'</span>',
                        "thumbnail" => '<img width="273" height="273" src="'.$photoUrl.$result->image.'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />',
                    );
                }
            } else {
                $suggestions[] = array(
                    "value" => 'Nenhum produto encontrado',
                    "permalink" => ''
                );
            }


        } else {
            $suggestions[] = array(
                "value" => 'Digite no mínimo 3 caracteries',
                "permalink" => ''
            );

        }

        $out = array(
            "suggestions" => $suggestions
        );


        return response()->json($out);

    }



    /**
     * Date: 06/29/2019
     *
     * @param $pa_color
     * @param $pa_size
     * @param $price
     * @param $regular_price
     * @param $data
     * @param $path
     * @param $color
     * @param $item
     * @return array
     */
    public function getAttributes($pa_color, $pa_size, $price, $regular_price, $data, $path, $color, $item)
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
                "title" => $data->product->name,
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
            "image_id" => "{$data->id}",
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
     * Date: 06/29/2019
     *
     * @param $data
     * @param $section
     * @param $category
     * @param $product
     * @param $path
     * @return array
     */
    public function schemaOrg($data, $section, $category, $product, $path, $offer_cash)
    {
        /**
         * Gerar json schema_org
         * https://schema.org/
         */
        $itemListElement[] = array(
            "@type" => "ListItem",
            "position" => 1,
            "item" => array(
                "name" => "Home",
                "@id" =>  route('home')
            )
        );
        $itemListElement[] = array(
            "@type" => "ListItem",
            "position" => 2,
            "item" => array(
                "name" => $category->name,
                "@id" =>  url(setRoute('category').$category->slug)
            )
        );
        $itemListElement[] = array(
            "@type" => "ListItem",
            "position" => 3,
            "item" => array(
                "name" => $section->name,
                "@id" =>  url(setRoute('section').$section->slug)
            )
        );
        $itemListElement[] = array(
            "@type" => "ListItem",
            "position" => 4,
            "item" => array(
                "name" => $product->name,
                "@id" =>  url(setRoute('color').$data->slug)
            )
        );
        $offer = array();
        if ($product->offer == 1) {
            $offer[] = array(
                "@type" => "Offer",
                "price" => "{$offer_cash}",
                "priceSpecification" => array(
                    "price" => "{$offer_cash}",
                    "priceCurrency" => "BRL",
                    "valueAddedTaxIncluded" => "false"
                ),
                "priceCurrency" => "BRL",
                "availability" => "https://schema.org/InStock",
                "url" => url(setRoute('color').$data->slug),
                "seller" => array(
                    "@type" => "Organization",
                    "name" => "{$product->name}",
                    "url" => url(setRoute('color').$data->slug)
                )
            );
        }


        $graph[] = array(
            "@context" => "https://schema.org/",
            "@type" => "BreadcrumbList",
            "itemListElement" => $itemListElement
        );
        $graph[] = array(
            "@context" => "https://schema.org/",
            "@type" => "Product",
            "@id" => url(setRoute('color').$data->slug),
            "name" => "{$product->name}",
            "image" => asset($path['G'].$data->image),
            "description" => "<p>{$product->description}</p>",
            "sku" => "",
            "offers" => $offer,
            "aggregateRating" => array(
                "@type" =>  "AggregateRating",
                "ratingValue" =>  "5.00",
                "reviewCount" => 1
            )
        );
        // comment
        $graph[] = array(
            "@context" => "https://schema.org/",
            "@type" => "Review",
            "@id" => url(setRoute('color').$data->slug)."#comment-81",
            "datePublished" => $product->updated_at,
            "description" => constLang('comment').'!',
            "itemReviewed" =>  array(
                "@type" => "Product",
                "name" => $product->name,
            ),
            "reviewRating" => array(
                "@type" =>  "rating",
                "ratingValue" =>  "5"
            ),
            "author" => array(
                "@type" =>  "Person",
                "name" =>  "Anselmo Velame"
            )
        );


        return $graph;

    }

}
