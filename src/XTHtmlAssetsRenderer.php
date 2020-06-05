<?php

/*
 * @package     Extly Infrastructure Support
 *
 * @author      Extly, CB. <team@extly.com>
 * @copyright   Copyright (c)2012-2020 Extly, CB. All rights reserved.
 * @license     http://www.gnu.org/licenses/gpl-3.0.html  GNU/GPLv3
 *
 * @see         https://www.extly.com
 */

namespace Extly\CMS\Document\Renderer\Html;

\defined('JPATH_PLATFORM') or die;

use Extly\Infrastructure\Support\HtmlAsset\HtmlAssetTagsBuilder;
use Extly\Infrastructure\Support\HtmlAsset\Repository;
use Illuminate\Support\Collection;
use Joomla\CMS\Document\Renderer\Html\HeadRenderer;

/**
 * HTML document renderer for the document `<head>` element.
 */
class XTHtmlAssetsRenderer extends HeadRenderer
{
    /**
     * Renders the document head and returns the results as a string.
     *
     * @param string $head    (unused)
     * @param array  $params  Associative array of values
     * @param string $content The script
     *
     * @return string The output of the script
     */
    public function render($head, $params = [], $content = null)
    {
        $document = $this->_doc;
        $allowedScriptsAndStylesheets = Collection::create(
            preg_split(
                '/[\s,]+/',
                $document->params->get('allowedScriptsAndStylesheets')
            )
        );

        // Nothing loaded by default
        $document->_styleSheets = $this->filter(
            Collection::create($document->_styleSheets),
            $allowedScriptsAndStylesheets
        );
        $document->_style = $this->filter(
            Collection::create($document->_style),
            $allowedScriptsAndStylesheets
        );
        $document->_scripts = $this->filter(
            Collection::create($document->_scripts),
            $allowedScriptsAndStylesheets
        );
        $document->_script = $this->filter(
            Collection::create($document->_script),
            $allowedScriptsAndStylesheets
        );

        // My Script and Styles
        $headScript = HtmlAssetTagsBuilder::create()->generate(Repository::GLOBAL_POSITION_HEAD);

        return parent::render($head, $params, $content).$headScript;
    }

    private function filter(Collection $items, Collection $allowedScriptsAndStylesheets)
    {
        return $items->filter(function ($item, $key) use ($allowedScriptsAndStylesheets) {
            $matched = $allowedScriptsAndStylesheets->first(function ($keyword) use ($item, $key) {
                if ('*' === $keyword) {
                    return true;
                }

                // Test File Key
                if (false !== strpos($key, $keyword)) {
                    return true;
                }

                // Test Item
                if (\is_string($item) && false !== strpos($item, $keyword)) {
                    return true;
                }

                // Test Type
                if (\is_array($item) && isset($item['type']) && false !== strpos($item['type'], $keyword)) {
                    return true;
                }

                return false;
            });

            return null !== $matched;
        })->toArray();
    }
}
