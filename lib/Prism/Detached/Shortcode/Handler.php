<?php

/**
 * Registers and handles the shortcode
 */
class Prism_Detached_Shortcode_Handler
{
    /**
     * The given attributes of the short code
     *
     * @var Prism_Detached_Shortcode_Parameters
     */
    private $parameters;


    /**
     * Registers the prism short code
     */
    function __construct ($parameters)
    {
        $this->parameters = new Prism_Detached_Shortcode_Parameters($parameters);
    }



    /**
     * Checks, whether all required parameters are set
     *
     * @return bool
     */
    private function hasRequiredParametersSet ()
    {
        return !is_null($this->parameters->getKey());
    }



    /**
     * Injects the actual code
     *
     * @return string
     */
    public function handle ()
    {
        if (!$this->hasRequiredParametersSet())
        {
            return "";
        }

        $content = get_post_meta($this->parameters->getPostId(), $this->parameters->getKey(), true);

        // if content is empty
        if (empty($content))
        {
            return "";
        }

        $tagAttributes = $this->getTagAttributes();
        return '<pre' . $this->getTagAttributeString($tagAttributes) . '><code>' . esc_html($content) .  '</code></pre>';
    }



    /**
     * Prepares the tag attributes
     *
     * @return array
     */
    private function getTagAttributes ()
    {
        $tagAttributes = array();

        if (!is_null($this->parameters->getHighlightLanguage()))
        {
            $tagAttributes['class'] = "language-{$this->parameters->getHighlightLanguage()}";
        }

        if (!is_null($this->parameters->getLineHighlight()))
        {
            $tagAttributes['data-line'] = $this->parameters->getLineHighlight();

            if (0 < $this->parameters->getLineOffset())
            {
                $tagAttributes['data-line-offset'] = $this->parameters->getLineOffset();
            }
        }

        return $tagAttributes;
    }



    /**
     * Transforms the tag attributes array to a string
     *
     * @param array $tagAttributes
     *
     * @return string
     */
    private function getTagAttributeString (array $tagAttributes)
    {
        $tagAttributeString = "";

        if (!empty($tagAttributes))
        {
            foreach ($tagAttributes as $key => $tagAttribute)
            {
                $tagAttributeString .= " {$key}=\"" . esc_attr($tagAttribute) . '"';
            }
        }

        return $tagAttributeString;
    }



    /**
     * Registers the short code
     */
    public static function register ()
    {
        add_shortcode('prism',
            function ($attributes)
            {
                $shortCode = new Prism_Detached_Shortcode_Handler($attributes);
                return $shortCode->handle();
            }
        );
    }
}