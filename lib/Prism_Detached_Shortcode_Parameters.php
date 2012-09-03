<?php

/**
 *
 */
class Prism_Detached_Shortcode_Parameters
{
    /**
     * The custom field key
     *
     * @var string|null
     */
    private $key = null;


    /**
     * The attribute content, which lines should be highlighted
     *
     * @var string|null
     */
    private $lineHighlight = null;


    /**
     * The post id to load the content from
     *
     * @var null|int
     */
    private $postId = null;


    /**
     * The highlighted language
     *
     * @var string|null
     */
    private $highlightLanguage = null;


    /**
     * The line offset
     *
     * @var int
     */
    private $lineOffset = 0;



    /**
     * Constructs the parameters object
     *
     * @param string|array $parameters
     */
    public function __construct ($parameters)
    {
        $parameters = (is_array($parameters) && !empty($parameters)) ? $parameters : array();
        $this->parseValues($parameters);
        $this->prepareValues();
    }



    /**
     * Parses the raw shortcode parameters
     */
    private function parseValues (array $attributes)
    {
        $this->key = isset($attributes['key']) ? $attributes['key'] : null;
        $this->lineHighlight = isset($attributes['line']) ? $attributes['line'] : null;

        $this->postId = (isset($attributes['post']) && ctype_digit($attributes['post']))
                ? (int) $attributes['post']
                : null;

        $this->highlightLanguage = isset($attributes['language']) ? $attributes['language'] : null;
        $this->lineOffset = (isset($attributes['line_offset']) && ctype_digit($attributes['line_offset']))
                ? (int) $attributes['line_offset']
                : null;
    }



    /**
     * Prepares the parsed values
     */
    private function prepareValues ()
    {
        global $post;

        if (is_null($this->postId))
        {
            $this->postId = $post->ID;
        }
    }



    /**
     * @return null|string
     */
    public function getHighlightLanguage ()
    {
        return $this->highlightLanguage;
    }



    /**
     * @return null|string
     */
    public function getKey ()
    {
        return $this->key;
    }



    /**
     * @return null|string
     */
    public function getLineHighlight ()
    {
        return $this->lineHighlight;
    }



    /**
     * @return int|null
     */
    public function getPostId ()
    {
        return $this->postId;
    }



    /**
     * @return int
     */
    public function getLineOffset ()
    {
        return $this->lineOffset;
    }
}