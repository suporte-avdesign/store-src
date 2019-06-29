<?php

namespace AVD\Http\Controllers\Web;

use Illuminate\Http\Request;
use AVD\Http\Controllers\Controller;

use AVD\Interfaces\Web\SectionInterface as InterSection;
use AVD\Interfaces\Web\ConfigSiteInterface as ConfigSite;
use AVD\Interfaces\Web\ImageColorInterface as InterModel;
use AVD\Interfaces\Web\CategoryInterface as InterCategory;
use AVD\Interfaces\Web\SocialShareInterface as InterSocial;
use AVD\Interfaces\Web\ConfigProductInterface as ConfigProduct;
use AVD\Interfaces\Web\ConfigKeywordInterface as ConfigKeyword;
use AVD\Interfaces\Web\ConfigColorPositionInterface as ConfigImages;
use Illuminate\Support\Str;


class ImageColorController extends Controller
{


    public function __construct(
        ConfigSite $configSite,
        InterModel $interModel,
        InterSocial $interSocial,
        InterSection $interSection,
        ConfigImages $configImages,
        InterCategory $interCategory,
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


        $data = $this->interModel->get($slug);

        $section  = $data->product->section()->first();
        $category = $data->product->category()->first();
        $product  = $data->product()->first();
        $colors   = $product->images;

        foreach ($data->product->prices as $value) {
            if ($value->profile == $configProduct->price_default) {
                $display_price = $value->price_cash;
                $display_regular_price = $value->price_card;

                if ($product->offer == 1) {
                    $price_cash = $value->price_cash;
                    $offer_cash = $value->offer_cash;
                }
            }
        }

        foreach ($colors as $color) {
            foreach ($color->grids as $item) {
                if ($product->kit == 1){
                    $attribute_pa_color = Str::slug($color->color).'|'.$item->id;
                    $attribute_pa_size = $item->units.Str::slug($product->measure);
                } else {
                    $attribute_pa_color = Str::slug($color->color);
                    $attribute_pa_size = $item->grid;
                }
                $out[] = array(
                    "attributes" => array(
                        "attribute_pa_color" => $attribute_pa_color,
                        "attribute_pa_size" => $attribute_pa_size
                    ),
                    "availability_html" => "",
                    "backorders_allowed" => false,
                    "dimensions" => array(
                        "length" => "",
                        "width" => "",
                        "height" => ""
                    ),
                    "dimensions_html" => "N/A",
                    "display_price" => (int) $display_price,
                    "display_regular_price" => (int) $display_regular_price,
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
            }
        }


        //dd($out);

        /*
        $attributes = array();
        if ($product->kit == 1) {
            foreach ($out as $val) {
                $array1[] = $val['attributes'];
            }

            foreach ($array1 as $attr) {
                $array2['pa_size'][] = $attr['attribute_pa_size'];
                $array2['name'][] = $attr['attribute_size_name'];
            }

            $array3['name'] = array_unique($array2['name']);
            $array3['pa_size'] = array_unique($array2['pa_size']);
            $pa_name  = collect($array3['name'])->values();
            $pa_size  = collect($array3['pa_size'])->values();

            for ($i = 0; $i <= count($pa_size)-1; $i++) {
                $attributes[$i] = array($pa_size[$i] => $pa_name[$i]);
            }
        }

        */




        // Substituir aspas pelo código html <form product_variations"[{}]"
        //$product_variations = str_replace('"', "&quot;", json_encode($out));
        $product_variations = json_encode($out);

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
                "name" => "sandalias",
                "@id" =>  route('home') //route category
            )
        );
        $itemListElement[] = array(
            "@type" => "ListItem",
            "position" => 3,
            "item" => array(
                "name" => "feminino",
                "@id" =>  route('home') //route section
            )
        );
        $itemListElement[] = array(
            "@type" => "ListItem",
            "position" => 4,
            "item" => array(
                "name" => "produto",
                "@id" =>  route('home') //route product
            )
        );
        $offer = array();
        if ($product->offer == 1) {
            $offer[] = array(
                "@type" => "Offer",
                "price" => "45,00",
                "priceSpecification" => array(
                    "price" => "45,00",
                    "priceCurrency" => "BRL",
                    "valueAddedTaxIncluded" => "false"
                ),
                "priceCurrency" => "BRL",
                "availability" => "https://schema.org/InStock",
                "url" => route('home'), // route product
                "seller" => array(
                    "@type" => "Organization",
                    "name" => "{$product->name}",
                    "url" => url(setRoute('color') . $data->slug)
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
            "datePublished" => "{$product->	updated_at}",
            "description" => constLang('comment').'!',
            "itemReviewed" =>  array(
                "@type" => "Product",
                "name" => "{$product->name}",
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

        $schema_org = array(
            "@context" => "https://schema.org/",
            "@graph" => $graph
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
        $query = $request['query'];


        $products[] = array(
            "value" => "Produto 1",
            "permalink" => "#",
            "price" => '<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$ </span>71,00</span>',
            "thumbnail" => '<img width="273" height="273" src="'.asset('faker/product_photos/img1-f.jpg').'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />',
        );

        $products[] = array(
            "value" => "Produto 2",
            "permalink" => "#",
            "price" => '<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$ </span>82,00</span>',
            "thumbnail" => '<img width="273" height="273" src="'.asset('faker/product_photos/img2-f.jpg').'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />',
        );

        $products[] = array(
            "value" => "Produto 3",
            "permalink" => "#",
            "price" => '<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$ </span>76,00</span>',
            "thumbnail" => '<img width="273" height="273" src="'.asset('faker/product_photos/img3-f.jpg').'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />',
        );

        $products[] = array(
            "value" => "Produto 4",
            "permalink" => "#",
            "price" => '<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$ </span>71,00</span>',
            "thumbnail" => '<img width="273" height="273" src="'.asset('faker/product_photos/img4-f.jpg').'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />',
        );

        $products[] = array(
            "value" => "Produto 5",
            "permalink" => "#",
            "price" => '<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$ </span>82,00</span>',
            "thumbnail" => '<img width="273" height="273" src="'.asset('faker/product_photos/img5-f.jpg').'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />',
        );

        $products[] = array(
            "value" => "Produto 6",
            "permalink" => "#",
            "price" => '<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$ </span>76,00</span>',
            "thumbnail" => '<img width="273" height="273" src="'.asset('faker/product_photos/img6-f.jpg').'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />',
        );

        $products[] = array(
            "value" => "Produto 7",
            "permalink" => "#",
            "price" => '<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$ </span>71,00</span>',
            "thumbnail" => '<img width="273" height="273" src="'.asset('faker/product_photos/img7-f.jpg').'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />',
        );

        $products[] = array(
            "value" => "Produto 8",
            "permalink" => "#",
            "price" => '<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$ </span>82,00</span>',
            "thumbnail" => '<img width="273" height="273" src="'.asset('faker/product_photos/img8-f.jpg').'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />',
        );

        $products[] = array(
            "value" => "Produto 9",
            "permalink" => "#",
            "price" => '<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$ </span>76,00</span>',
            "thumbnail" => '<img width="273" height="273" src="'.asset('faker/product_photos/img9-f.jpg').'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />',
        );

        $products[] = array(
            "value" => "Produto 10",
            "permalink" => "#",
            "price" => '<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$ </span>71,00</span>',
            "thumbnail" => '<img width="273" height="273" src="'.asset('faker/product_photos/img10-f.jpg').'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />',
        );

        $products[] = array(
            "value" => "Produto 11",
            "permalink" => "#",
            "price" => '<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$ </span>82,00</span>',
            "thumbnail" => '<img width="273" height="273" src="'.asset('faker/product_photos/img11-f.jpg').'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />',
        );

        $products[] = array(
            "value" => "Produto 12",
            "permalink" => "#",
            "price" => '<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$ </span>76,00</span>',
            "thumbnail" => '<img width="273" height="273" src="'.asset('faker/product_photos/img12-f.jpg').'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />',
        );




        $out = array(
            "suggestions" => $products
        );


        return response()->json($out);

    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        // BRANCO 34
        $out[] = array(
            "attributes" => array(
                "attribute_pa_color" => "branco",
                "attribute_pa_size" => "34"
            ),
            "availability_html" => "",
            "backorders_allowed" => false,
            "dimensions" => array(
                "length" => "",
                "width" => "",
                "height" => ""
            ),
            "dimensions_html" => "N/A",
            "display_price" => 559,
            "display_regular_price" => 559,
            "image" => array(
                "title" => "Produto 1",
                "caption" => "",
                "url" => asset('faker/product_photos/img3-f.jpg'),
                "alt" => "",
                "src" => asset('faker/product_photos/img3-f.jpg'),
                "srcset" => asset('faker/product_photos/img3-f.jpg')." 870w, ".asset('faker/product_photos/img3-f.jpg')." 546w, ".asset('faker/product_photos/img3-f.jpg')." 273w, ".asset('faker/product_photos/img3-f.jpg')." 235w, ".asset('faker/product_photos/img3-f.jpg')." 768w, ".asset('faker/product_photos/img3-f.jpg')." 803w, ".asset('faker/product_photos/img3-f.jpg')." 266w, ".asset('faker/product_photos/img3-f.jpg')." 219w, ".asset('faker/product_photos/img3-f.jpg')." 263w, ".asset('faker/product_photos/img3-f.jpg')." 526w",
                "sizes" => "(max-width => 870px) 100vw, 870px",
                "full_src" => asset('faker/product_photos/img3-f.jpg'),
                "full_src_w" => 870,
                "full_src_h" => 870,
                "gallery_thumbnail_src" => asset('faker/product_photos/img3-f.jpg'),
                "gallery_thumbnail_src_w" => 870,
                "gallery_thumbnail_src_h" => 870,
                "thumb_src" => asset('faker/product_photos/img3-f.jpg'),
                "thumb_src_w" => 273,
                "thumb_src_h" => 273,
                "src_w" => 870,
                "src_h" => 870
            ),
            "image_id" => "19503",
            "is_downloadable" => false,
            "is_in_stock" => true,
            "is_purchasable" => true,
            "is_sold_individually" => "no",
            "is_virtual" => false,
            "max_qty" => "",
            "min_qty" => 1,
            "price_html" => "",
            "sku" => "",
            "variation_description" => "",
            "variation_id" => 19748,
            "variation_is_active" => true,
            "variation_is_visible" => true,
            "weight" => "",
            "weight_html" => "N/A"
        );
        // BRANCO 35
        $out[] = array(
            "attributes" => array(
                "attribute_pa_color" => "branco",
                "attribute_pa_size" => "35"
            ),
            "availability_html" => "",
            "backorders_allowed" => false,
            "dimensions" => array(
                "length" => "",
                "width" => "",
                "height" => ""
            ),
            "dimensions_html" => "N/A",
            "display_price" => 559,
            "display_regular_price" => 559,
            "image" => array(
                "title" => "Produto 1",
                "caption" => "",
                "url" => asset('faker/product_photos/img3-f.jpg'),
                "alt" => "",
                "src" => asset('faker/product_photos/img3-f.jpg'),
                "srcset" => asset('faker/product_photos/img3-f.jpg')." 870w, ".asset('faker/product_photos/img3-f.jpg')." 546w, ".asset('faker/product_photos/img3-f.jpg')." 273w, ".asset('faker/product_photos/img3-f.jpg')." 235w, ".asset('faker/product_photos/img3-f.jpg')." 768w, ".asset('faker/product_photos/img3-f.jpg')." 803w, ".asset('faker/product_photos/img3-f.jpg')." 266w, ".asset('faker/product_photos/img3-f.jpg')." 219w, ".asset('faker/product_photos/img3-f.jpg')." 263w, ".asset('faker/product_photos/img3-f.jpg')." 526w",
                "sizes" => "(max-width => 870px) 100vw, 870px",
                "full_src" => asset('faker/product_photos/img3-f.jpg'),
                "full_src_w" => 870,
                "full_src_h" => 870,
                "gallery_thumbnail_src" => asset('faker/product_photos/img3-f.jpg'),
                "gallery_thumbnail_src_w" => 870,
                "gallery_thumbnail_src_h" => 870,
                "thumb_src" => asset('faker/product_photos/img3-f.jpg'),
                "thumb_src_w" => 273,
                "thumb_src_h" => 273,
                "src_w" => 870,
                "src_h" => 870
            ),
            "image_id" => "19503",
            "is_downloadable" => false,
            "is_in_stock" => true,
            "is_purchasable" => true,
            "is_sold_individually" => "no",
            "is_virtual" => false,
            "max_qty" => "",
            "min_qty" => 1,
            "price_html" => "",
            "sku" => "",
            "variation_description" => "",
            "variation_id" => 23727,
            "variation_is_active" => true,
            "variation_is_visible" => true,
            "weight" => "",
            "weight_html" => "N/A"
        );

        // BRANCO 33
        $out[] = array(
            "attributes" => array(
                "attribute_pa_color" => "branco",
                "attribute_pa_size" => "33"
            ),
            "availability_html" => "",
            "backorders_allowed" => false,
            "dimensions" => array(
                "length" => "",
                "width" => "",
                "height" => ""
            ),
            "dimensions_html" => "N/A",
            "display_price" => 559,
            "display_regular_price" => 559,
            "image" => array(
                "title" => "Produto 1",
                "caption" => "",
                "url" => asset('faker/product_photos/img3-f.jpg'),
                "alt" => "",
                "src" => asset('faker/product_photos/img3-f.jpg'),
                "srcset" => asset('faker/product_photos/img3-f.jpg')." 870w, ".asset('faker/product_photos/img3-f.jpg')." 546w, ".asset('faker/product_photos/img3-f.jpg')." 273w, ".asset('faker/product_photos/img3-f.jpg')." 235w, ".asset('faker/product_photos/img3-f.jpg')." 768w, ".asset('faker/product_photos/img3-f.jpg')." 803w, ".asset('faker/product_photos/img3-f.jpg')." 266w, ".asset('faker/product_photos/img3-f.jpg')." 219w, ".asset('faker/product_photos/img3-f.jpg')." 263w, ".asset('faker/product_photos/img3-f.jpg')." 526w",
                "sizes" => "(max-width => 870px) 100vw, 870px",
                "full_src" => asset('faker/product_photos/img3-f.jpg'),
                "full_src_w" => 870,
                "full_src_h" => 870,
                "gallery_thumbnail_src" => asset('faker/product_photos/img3-f.jpg'),
                "gallery_thumbnail_src_w" => 870,
                "gallery_thumbnail_src_h" => 870,
                "thumb_src" => asset('faker/product_photos/img3-f.jpg'),
                "thumb_src_w" => 273,
                "thumb_src_h" => 273,
                "src_w" => 870,
                "src_h" => 870
            ),
            "image_id" => "19506",
            "is_downloadable" => false,
            "is_in_stock" => true,
            "is_purchasable" => true,
            "is_sold_individually" => "no",
            "is_virtual" => false,
            "max_qty" => "",
            "min_qty" => 1,
            "price_html" => "",
            "sku" => "",
            "variation_description" => "",
            "variation_id" => 23728,
            "variation_is_active" => true,
            "variation_is_visible" => true,
            "weight" => "",
            "weight_html" => "N/A"
        );

        // AMARELO 35
        $out[] = array(
            "attributes" => array(
                "attribute_pa_color" => "amarelo",
                "attribute_pa_size" => "35"
            ),
            "availability_html" => "",
            "backorders_allowed" => false,
            "dimensions" => array(
                "length" => "",
                "width" => "",
                "height" => ""
            ),
            "dimensions_html" => "N/A",
            "display_price" => 559,
            "display_regular_price" => 559,
            "image" => array(
                "title" => "Produto 1",
                "caption" => "",
                "url" => asset('faker/product_photos/img2-f.jpg'),
                "alt" => "",
                "src" => asset('faker/product_photos/img2-f.jpg'),
                "srcset" => asset('faker/product_photos/img2-f.jpg')." 870w, ".asset('faker/product_photos/img2-f.jpg')." 546w, ".asset('faker/product_photos/img2-f.jpg')." 273w, ".asset('faker/product_photos/img2-f.jpg')." 235w, ".asset('faker/product_photos/img2-f.jpg')." 768w, ".asset('faker/product_photos/img2-f.jpg')." 803w, ".asset('faker/product_photos/img2-f.jpg')." 266w, ".asset('faker/product_photos/img2-f.jpg')." 219w, ".asset('faker/product_photos/img2-f.jpg')." 263w, ".asset('faker/product_photos/img2-f.jpg')." 526w",
                "sizes" => "(max-width => 870px) 100vw, 870px",
                "full_src" => asset('faker/product_photos/img2-f.jpg'),
                "full_src_w" => 870,
                "full_src_h" => 870,
                "gallery_thumbnail_src" => asset('faker/product_photos/img2-f.jpg'),
                "gallery_thumbnail_src_w" => 870,
                "gallery_thumbnail_src_h" => 870,
                "thumb_src" => asset('faker/product_photos/img2-f.jpg'),
                "thumb_src_w" => 273,
                "thumb_src_h" => 273,
                "src_w" => 870,
                "src_h" => 870
            ),
            "image_id" => "19506",
            "is_downloadable" => false,
            "is_in_stock" => true,
            "is_purchasable" => true,
            "is_sold_individually" => "no",
            "is_virtual" => false,
            "max_qty" => "",
            "min_qty" => 1,
            "price_html" => "",
            "sku" => "",
            "variation_description" => "",
            "variation_id" => 19747,
            "variation_is_active" => true,
            "variation_is_visible" => true,
            "weight" => "",
            "weight_html" => "N/A"
        );
        // AMARELO 34
        $out[] = array(
            "attributes" => array(
                "attribute_pa_color" => "amarelo",
                "attribute_pa_size" => "34"
            ),
            "availability_html" => "",
            "backorders_allowed" => false,
            "dimensions" => array(
                "length" => "",
                "width" => "",
                "height" => ""
            ),
            "dimensions_html" => "N/A",
            "display_price" => 559,
            "display_regular_price" => 559,
            "image" => array(
                "title" => "Produto 1",
                "caption" => "",
                "url" => asset('faker/product_photos/img2-f.jpg'),
                "alt" => "",
                "src" => asset('faker/product_photos/img2-f.jpg'),
                "srcset" => asset('faker/product_photos/img2-f.jpg')." 870w, ".asset('faker/product_photos/img2-f.jpg')." 546w, ".asset('faker/product_photos/img2-f.jpg')." 273w, ".asset('faker/product_photos/img2-f.jpg')." 235w, ".asset('faker/product_photos/img2-f.jpg')." 768w, ".asset('faker/product_photos/img2-f.jpg')." 803w, ".asset('faker/product_photos/img2-f.jpg')." 266w, ".asset('faker/product_photos/img2-f.jpg')." 219w, ".asset('faker/product_photos/img2-f.jpg')." 263w, ".asset('faker/product_photos/img2-f.jpg')." 526w",
                "sizes" => "(max-width => 870px) 100vw, 870px",
                "full_src" => asset('faker/product_photos/img2-f.jpg'),
                "full_src_w" => 870,
                "full_src_h" => 870,
                "gallery_thumbnail_src" => asset('faker/product_photos/img2-f.jpg'),
                "gallery_thumbnail_src_w" => 870,
                "gallery_thumbnail_src_h" => 870,
                "thumb_src" => asset('faker/product_photos/img2-f.jpg'),
                "thumb_src_w" => 273,
                "thumb_src_h" => 273,
                "src_w" => 870,
                "src_h" => 870
            ),
            "image_id" => "19506",
            "is_downloadable" => false,
            "is_in_stock" => true,
            "is_purchasable" => true,
            "is_sold_individually" => "no",
            "is_virtual" => false,
            "max_qty" => "",
            "min_qty" => 1,
            "price_html" => "",
            "sku" => "",
            "variation_description" => "",
            "variation_id" => 23729,
            "variation_is_active" => true,
            "variation_is_visible" => true,
            "weight" => "",
            "weight_html" => "N/A"
        );
        // AMARELO 33
        $out[] = array(
            "attributes" => array(
                "attribute_pa_color" => "amarelo",
                "attribute_pa_size" => "33"
            ),
            "availability_html" => "",
            "backorders_allowed" => false,
            "dimensions" => array(
                "length" => "",
                "width" => "",
                "height" => ""
            ),
            "dimensions_html" => "N/A",
            "display_price" => 559,
            "display_regular_price" => 559,
            "image" => array(
                "title" => "Produto 1",
                "caption" => "",
                "url" => asset('faker/product_photos/img2-f.jpg'),
                "alt" => "",
                "src" => asset('faker/product_photos/img2-f.jpg'),
                "srcset" => asset('faker/product_photos/img2-f.jpg')." 870w, ".asset('faker/product_photos/img2-f.jpg')." 546w, ".asset('faker/product_photos/img2-f.jpg')." 273w, ".asset('faker/product_photos/img2-f.jpg')." 235w, ".asset('faker/product_photos/img2-f.jpg')." 768w, ".asset('faker/product_photos/img2-f.jpg')." 803w, ".asset('faker/product_photos/img2-f.jpg')." 266w, ".asset('faker/product_photos/img2-f.jpg')." 219w, ".asset('faker/product_photos/img2-f.jpg')." 263w, ".asset('faker/product_photos/img2-f.jpg')." 526w",
                "sizes" => "(max-width => 870px) 100vw, 870px",
                "full_src" => asset('faker/product_photos/img2-f.jpg'),
                "full_src_w" => 870,
                "full_src_h" => 870,
                "gallery_thumbnail_src" => asset('faker/product_photos/img2-f.jpg'),
                "gallery_thumbnail_src_w" => 870,
                "gallery_thumbnail_src_h" => 870,
                "thumb_src" => asset('faker/product_photos/img2-f.jpg'),
                "thumb_src_w" => 273,
                "thumb_src_h" => 273,
                "src_w" => 870,
                "src_h" => 870
            ),
            "image_id" => "19506",
            "is_downloadable" => false,
            "is_in_stock" => true,
            "is_purchasable" => true,
            "is_sold_individually" => "no",
            "is_virtual" => false,
            "max_qty" => "",
            "min_qty" => 1,
            "price_html" => "",
            "sku" => "",
            "variation_description" => "",
            "variation_id" => 23730,
            "variation_is_active" => true,
            "variation_is_visible" => true,
            "weight" => "",
            "weight_html" => "N/A"
        );

        // AZUL 33
        $out[] = array(
            "attributes" => array(
                "attribute_pa_color" => "azul",
                "attribute_pa_size" => "33"
            ),
            "availability_html" => "",
            "backorders_allowed" => false,
            "dimensions" => array(
                "length" => "",
                "width" => "",
                "height" => ""
            ),
            "dimensions_html" => "N/A",
            "display_price" => 559,
            "display_regular_price" => 559,
            "image" => array(
                "title" => "Produto 1",
                "caption" => "",
                "url" => asset('faker/product_photos/img1-f.jpg'),
                "alt" => "",
                "src" => asset('faker/product_photos/img1-f.jpg'),
                "srcset" => asset('faker/product_photos/img1-f.jpg')." 870w, ".asset('faker/product_photos/img1-f.jpg')." 546w, ".asset('faker/product_photos/img1-f.jpg')." 273w, ".asset('faker/product_photos/img1-f.jpg')." 235w, ".asset('faker/product_photos/img1-f.jpg')." 768w, ".asset('faker/product_photos/img1-f.jpg')." 803w, ".asset('faker/product_photos/img1-f.jpg')." 266w, ".asset('faker/product_photos/img1-f.jpg')." 219w, ".asset('faker/product_photos/img1-f.jpg')." 263w, ".asset('faker/product_photos/img1-f.jpg')." 526w",
                "sizes" => "(max-width => 870px) 100vw, 870px",
                "full_src" => asset('faker/product_photos/img1-f.jpg'),
                "full_src_w" => 870,
                "full_src_h" => 870,
                "gallery_thumbnail_src" => asset('faker/product_photos/img1-f.jpg'),
                "gallery_thumbnail_src_w" => 870,
                "gallery_thumbnail_src_h" => 870,
                "thumb_src" => asset('faker/product_photos/img1-f.jpg'),
                "thumb_src_w" => 273,
                "thumb_src_h" => 273,
                "src_w" => 870,
                "src_h" => 870
            ),
            "image_id" => "19512",
            "is_downloadable" => false,
            "is_in_stock" => true,
            "is_purchasable" => true,
            "is_sold_individually" => "no",
            "is_virtual" => false,
            "max_qty" => "",
            "min_qty" => 1,
            "price_html" => "",
            "sku" => "",
            "variation_description" => "",
            "variation_id" => 19749,
            "variation_is_active" => true,
            "variation_is_visible" => true,
            "weight" => "",
            "weight_html" => "N/A"
        );
        // AZUL 35
        $out[] = array(
            "attributes" => array(
                "attribute_pa_color" => "azul",
                "attribute_pa_size" => "35"
            ),
            "availability_html" => "",
            "backorders_allowed" => false,
            "dimensions" => array(
                "length" => "",
                "width" => "",
                "height" => ""
            ),
            "dimensions_html" => "N/A",
            "display_price" => 559,
            "display_regular_price" => 559,
            "image" => array(
                "title" => "Produto 1",
                "caption" => "",
                "url" => asset('faker/product_photos/img1-f.jpg'),
                "alt" => "",
                "src" => asset('faker/product_photos/img1-f.jpg'),
                "srcset" => asset('faker/product_photos/img1-f.jpg')." 870w, ".asset('faker/product_photos/img1-f.jpg')." 546w, ".asset('faker/product_photos/img1-f.jpg')." 273w, ".asset('faker/product_photos/img1-f.jpg')." 235w, ".asset('faker/product_photos/img1-f.jpg')." 768w, ".asset('faker/product_photos/img1-f.jpg')." 803w, ".asset('faker/product_photos/img1-f.jpg')." 266w, ".asset('faker/product_photos/img1-f.jpg')." 219w, ".asset('faker/product_photos/img1-f.jpg')." 263w, ".asset('faker/product_photos/img1-f.jpg')." 526w",
                "sizes" => "(max-width => 870px) 100vw, 870px",
                "full_src" => asset('faker/product_photos/img1-f.jpg'),
                "full_src_w" => 870,
                "full_src_h" => 870,
                "gallery_thumbnail_src" => asset('faker/product_photos/img1-f.jpg'),
                "gallery_thumbnail_src_w" => 870,
                "gallery_thumbnail_src_h" => 870,
                "thumb_src" => asset('faker/product_photos/img1-f.jpg'),
                "thumb_src_w" => 273,
                "thumb_src_h" => 273,
                "src_w" => 870,
                "src_h" => 870
            ),
            "image_id" => "19512",
            "is_downloadable" => false,
            "is_in_stock" => true,
            "is_purchasable" => true,
            "is_sold_individually" => "no",
            "is_virtual" => false,
            "max_qty" => "",
            "min_qty" => 1,
            "price_html" => "",
            "sku" => "",
            "variation_description" => "",
            "variation_id" => 23725,
            "variation_is_active" => true,
            "variation_is_visible" => true,
            "weight" => "",
            "weight_html" => "N/A"
        );
        // AZUL 34
        $out[] = array(
            "attributes" => array(
                "attribute_pa_color" => "azul",
                "attribute_pa_size" => "34"
            ),
            "availability_html" => "",
            "backorders_allowed" => false,
            "dimensions" => array(
                "length" => "",
                "width" => "",
                "height" => ""
            ),
            "dimensions_html" => "N/A",
            "display_price" => 559,
            "display_regular_price" => 559,
            "image" => array(
                "title" => "Produto 1",
                "caption" => "",
                "url" => asset('faker/product_photos/img1-f.jpg'),
                "alt" => "",
                "src" => asset('faker/product_photos/img1-f.jpg'),
                "srcset" => asset('faker/product_photos/img1-f.jpg')." 870w, ".asset('faker/product_photos/img1-f.jpg')." 546w, ".asset('faker/product_photos/img1-f.jpg')." 273w, ".asset('faker/product_photos/img1-f.jpg')." 235w, ".asset('faker/product_photos/img1-f.jpg')." 768w, ".asset('faker/product_photos/img1-f.jpg')." 803w, ".asset('faker/product_photos/img1-f.jpg')." 266w, ".asset('faker/product_photos/img1-f.jpg')." 219w, ".asset('faker/product_photos/img1-f.jpg')." 263w, ".asset('faker/product_photos/img1-f.jpg')." 526w",
                "sizes" => "(max-width => 870px) 100vw, 870px",
                "full_src" => asset('faker/product_photos/img1-f.jpg'),
                "full_src_w" => 870,
                "full_src_h" => 870,
                "gallery_thumbnail_src" => asset('faker/product_photos/img1-f.jpg'),
                "gallery_thumbnail_src_w" => 870,
                "gallery_thumbnail_src_h" => 870,
                "thumb_src" => asset('faker/product_photos/img1-f.jpg'),
                "thumb_src_w" => 273,
                "thumb_src_h" => 273,
                "src_w" => 870,
                "src_h" => 870
            ),
            "image_id" => "19512",
            "is_downloadable" => false,
            "is_in_stock" => true,
            "is_purchasable" => true,
            "is_sold_individually" => "no",
            "is_virtual" => false,
            "max_qty" => "",
            "min_qty" => 1,
            "price_html" => "",
            "sku" => "",
            "variation_description" => "",
            "variation_id" => 23726,
            "variation_is_active" => true,
            "variation_is_visible" => true,
            "weight" => "",
            "weight_html" => "N/A"
        );


        // Substituir aspas pelo código html <form product_variations"[{}]"
        //$product_variations = str_replace('"', "&quot;", json_encode($out));
        $product_variations = json_encode($out);


        return view('products.product-1-view', compact('product_variations'));
    }

}
