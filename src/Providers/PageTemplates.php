<?php

namespace ClimbingCard\Providers;

use function ClimbingCard\views_path;

class PageTemplates
{
    /**
     * The array of templates that this plugin tracks.A
     * 
     * @type array
     */
    protected $templates;

    /**
     * Initialize registration of page templates.
     *
     * @return void
     */
    public function init()
    {
        $this->templates = array();

        add_filter('theme_page_templates', array($this, 'addNewTemplate'));

        // Add a filter to the save post to inject out template into the page cache
        add_filter('wp_insert_post_data', array($this, 'registerProjectTemplates'));

        // Add a filter to the template include to determine if the page has our 
        // template assigned and return it's path
        add_filter('template_include', array($this, 'viewProjectTemplate'));

        // Add your templates to this array.
        $this->templates = array('journal/index.php' => __('Climbing Carts', 'climbing-card'));
    }

    /**
     * Adds our template to the page dropdown for v4.7+
     *
     */
    public function addNewTemplate($posts_templates)
    {
        $posts_templates = array_merge($posts_templates, $this->templates);

        return $posts_templates;
    }

    /**
     * Adds our template to the pages cache in order to trick WordPress
     * into thinking the template file exists where it doesn't really exist.
     */
    public function registerProjectTemplates($atts)
    {
        // Create the key used for the themes cache
        $cache_key = 'page_templates-' . md5(get_theme_root() . '/' . get_stylesheet());

        // Retrieve the cache list. 
        // If it doesn't exist, or it's empty prepare an array
        $templates = wp_get_theme()->get_page_templates();

        if (empty($templates)) {
            $templates = array();
        }

        // New cache, therefore remove the old one
        wp_cache_delete($cache_key, 'themes');

        // Now add our template to the list of templates by merging our templates
        // with the existing templates array from the cache.
        $templates = array_merge($templates, $this->templates);

        // Add the modified cache to allow WordPress to pick it up for listing
        // available templates
        wp_cache_add($cache_key, $templates, 'themes', 1800);

        return $atts;
    }

    /**
     * Checks if the template is assigned to the page
     */
    public function viewProjectTemplate($template)
    {
        // Get global post
        global $post;

        // Return template if post is empty
        if (!$post) {
            return $template;
        }

        // Return default template if we don't have a custom one defined
        if (!isset($this->templates[get_post_meta($post->ID, '_wp_page_template', true)])) {
            return $template;
        }

        $file = views_path() . get_post_meta($post->ID, '_wp_page_template', true);

        // Just to be safe, we check if the file exist first
        if (file_exists($file)) {
            return $file;
        } else {
            echo $file;
        }

        // Return template
        return $template;
    }
}
