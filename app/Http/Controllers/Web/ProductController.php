<?php

namespace AVD\Http\Controllers\Web;

use Illuminate\Http\Request;
use AVD\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        // Set product nex e prev
        $product_prev = array('nome-categoria','nome-secao','none-produto-anterior');
        $product_next = array('nome-categoria','nome-secao','none-produto-proximo');

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
        // se estiver em oferta
        $offer[] = array(
            "@type" => "Offer",
            "price" => "45,00",
            "priceSpecification" => array(
                "price" => "45,00",
                "priceCurrency" =>  "BRL",
                "valueAddedTaxIncluded" => "false"
            ),
            "priceCurrency" => "BRL",
            "availability" => "https://schema.org/InStock",
            "url" => route('home'), // route product
            "seller" => array(
                "@type" => "Organization",
                "name" => "Nome do Produto",
                "url" => route('home')
            )
        );
        $graph[] = array(
            "@context" => "https://schema.org/",
            "@type" => "BreadcrumbList",
            "itemListElement" => $itemListElement
        );
        $graph[] = array(
            "@context" => "https://schema.org/",
            "@type" => "Product",
            "@id" => route('home'), // route product
            "name" => "Nome do produto",
            "image" => asset('faker/product_photos/img1-f.jpg'),
            "description" => "<p>Descrição do produto</p>",
            "sku" => "",
            "offers" => $offer,
            "aggregateRating" => array(
                "@type" =>  "AggregateRating",
                "ratingValue" =>  "5.00",
                "reviewCount" => 1
            )
        );
        $graph[] = array(
            "@context" => "https:\/\/schema.org\/",
            "@type" => "Review",
            "@id" => route('home')."#comment-81", // route product
            "datePublished" => "2016-04-25T20:55:19+00:00",
            "description" => "comentario!",
            "itemReviewed" =>  array(
                "@type" => "Product",
                "name" => "Nome do Produto"
            ),
            "reviewRating" => array(
                "@type" =>  "rating",
                "ratingValue" =>  "5"
            ),
            "author" => array(
                "@type" =>  "Person",
                "name" =>  "Anselmo"
            )
            );

        $schema_org = array(
            "@context" => "https://schema.org/",
            "@graph" => $graph
        );




        return view('products.product-1', compact(
            'product_prev',
            'product_next',
            'product_variations',
            'schema_org'
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
