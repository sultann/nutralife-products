<?php
namespace PluginEver\Nutralife;


class Product{
    public $ID;
    public $title;
    public $thumbnail;
    public $thumbnail_id;
    public $short_desc;
    public $description;
    public $pack_size;
    public $features;
    public $banner_type;
    public $banner_image;
    public $slider;
    public $categories;
    public $ingredients;
    public $heal_concerns;
    public $external_sources;
    public $breadcrumb;
    public $related_products;
    public $related_blogs;
    public $buy_link;
    private $post;


    /**
     * Product constructor.
     *
     * @param $ID
     */
    public function __construct( $ID ) {
        $this->ID = $ID;

        $post = get_post($ID);
        if($post->post_type !== 'product'){
            return new \WP_Error('post is not a product', 'Passed product id is not available ');
        }
        $this->post = $post;

        $this->setup_product_data();
    }


    protected function setup_product_data(){
        $this->title = $this->post->post_title;
        $this->short_desc = $this->get_short_desc();
        $this->description = $this->get_description();
        $this->thumbnail_id = $this->get_thumbnail_id();
        $this->thumbnail = $this->get_thumbnail();
        $this->pack_size = $this->get_pack_size();
        $this->features = $this->get_features();
        $this->banner_type = $this->get_banner_type();
        $this->banner_image = $this->get_banner_image();
        $this->slider = $this->get_slider();
        $this->categories = $this->get_categories();
        $this->ingredients = $this->get_ingredients();
        $this->heal_concerns = $this->get_heal_concerns();
        $this->external_sources = $this->get_external_sources();
        $this->related_products = $this->get_related_products();
        $this->buy_link = $this->get_buy_link();
    }


    protected function get_short_desc(){
        return substr( $this->post->post_excerpt, 0, 194 );
    }

    protected function get_description(){
        $content = $this->post->post_content;
        return apply_filters('the_content', $content);
    }

    protected function get_thumbnail_id(){
        if(has_post_thumbnail($this->ID)){
            return get_post_thumbnail_id($this->ID);
        }

        return false;
    }

    protected function get_default_image(){
        return NTLFP_DEFAULT_THUMB;
    }
    public function get_thumbnail($size='large'){
        if(has_post_thumbnail($this->ID)){
            return get_the_post_thumbnail_url($this->ID, $size);
        }

        return $this->get_default_image();
    }


    protected function get_pack_size(){
        $pack_size = get_post_meta($this->ID, 'pack_size', true);
        if(trim($pack_size) == ''){
            return false;
        }
        return $pack_size;
    }
    protected function get_features(){
        $features = get_post_meta($this->ID, 'features', true);
        if(is_array($features) && !empty($features)){
            return $features;
        }
        return false;
    }
    protected function get_banner_type(){
        $banner_type = get_post_meta($this->ID, 'banner_type', true);
        if(trim($banner_type) == ''){
            return false;
        }
        return $banner_type;
    }
    protected function get_banner_image(){
        $banner_image = get_post_meta($this->ID, 'banner_image', true);
        if(trim($banner_image) == ''){
            return false;
        }
        return $banner_image;
    }
    protected function get_slider(){
        $slider = get_post_meta($this->ID, 'slider_alias', true);
        if(trim($slider) == ''){
            return false;
        }
        return $slider;
    }
    protected function get_categories(){
        $args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
        $categories = wp_get_post_terms($this->ID, 'product_cats', $args);

        if(is_array($categories) && !empty($categories)){
            return $categories;
        }
        return false;
    }
    protected function get_heal_concerns(){
        $args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
        $categories = wp_get_post_terms($this->ID, 'health_concern', $args);

        if(is_array($categories) && !empty($categories)){
            return $categories;
        }
        return false;
    }
    protected function get_ingredients(){
        $args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
        $categories = wp_get_post_terms($this->ID, 'ingredient', $args);

        if(is_array($categories) && !empty($categories)){
            return $categories;
        }
        return false;
    }
    protected function get_buy_link(){
        $buy_link = get_post_meta($this->ID, 'buy_link', true);
        if(trim($buy_link) == ''){
            return false;
        }
        return $buy_link;
    }
    protected function get_external_sources(){
        $external_sources = get_post_meta($this->ID, 'external_sources', true);
        if(is_array($external_sources) && !empty($external_sources)){
            return $external_sources;
        }
        return false;
    }
    protected function get_related_products($limit=4){
        $categories = $this->categories;
        $categories_ids = wp_list_pluck($categories, 'term_id');

        $args = array(
            'post_type' => 'product',
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cats',
                    'field'    => 'term_id',
                    'terms'    => $categories_ids,
                    'operator' => 'IN',
                ),
            ),
        );
        $query = new \WP_Query( $args );

        wp_reset_query();
        $posts = array();
        if(isset($query->posts) && is_array($query->posts) && !empty($query->posts)){
            $posts = wp_list_pluck($query->posts, 'ID');
            $key = array_search($this->ID,$posts);

            if($key !== false){
                unset($posts[$key]);
            }
            $posts = array_slice($posts, 0,$limit);

        }


        if(!empty($posts)){
            return $posts;
        }
        return false;


    }
    protected function get_related_blogs(){}


}