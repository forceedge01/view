<?php

namespace Air\View;

class View implements ViewInterface
{
    /**
     * @var string $file The file to load.
     */
    protected $file;


    /**
     * @var array $data The data to inject.
     */
    protected $data = [];


    /**
     * @var RendererInterface $renderer The rendering engine.
     */
    protected $renderer;


    /**
     * @param RendererInterface $renderer The rendering engine.
     * @param string $file The file to load.
     * @param array $data The data to inject.
     */
    public function __construct(RendererInterface $renderer, $file, array $data = [])
    {
        $this->renderer = $renderer;
        $this->file = $file;
        $this->data = $data;
    }


    /**
     * Binds data to the view.
     *
     * @param string $key The key.
     * @param string $value The value.
     */
    public function __set($key, $value)
    {
        $this->set($key, $value);
    }


    /**
     * Gets the view data
     *
     * @param string $key The key.
     * @return mixed the view data.
     */
    public function __get($key)
    {
        return $this->get($key);
    }


    /**
     * Binds data to the view.
     *
     * @param string $key The key.
     * @param mixed $value The value.
     */
    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }


    /**
     * Check if data is binded to the view by key.
     *
     * @param string $key The data key to check.
     *
     * @return bool
     */
    public function exists($key)
    {
        return isset($this->data[$key]);
    }


    /**
     * Gets the view data.
     *
     * @param string $key The key.
     * @return mixed the view data.
     */
    public function get($key)
    {
        return $this->data[$key];
    }


    /**
     * Renders the view as a string.
     *
     * @return string The rendered view.
     */
    public function __toString()
    {
        return $this->render();
    }


    /**
     * Renders the view.
     *
     * @throws \Exception
     * @return string The rendered output.
     */
    public function render()
    {
        return $this->renderer->render($this->file, $this->data);
    }
}
