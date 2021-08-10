<?php

if ( ! function_exists('mix')) {
    /**
     * Get the path to a versioned Mix file.
     *
     * @param string $path
     * @param string $manifestDirectory
     *
     * @throws \Exception
     *
     * @return \Illuminate\Support\HtmlString|string
     */
    function mix($path, $manifestDirectory = '')
    {
        return app(\EOffice\UI\Mix::class)(...func_get_args());
    }
}
