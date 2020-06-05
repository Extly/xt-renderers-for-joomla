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
use Joomla\CMS\Document\Renderer\Html\HeadRenderer;

/**
 * HTML document renderer for the document `<head>` element.
 */
class XTHtmlAssetsBodyRenderer extends HeadRenderer
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
        return HtmlAssetTagsBuilder::create()->generate(Repository::GLOBAL_POSITION_BODY);
    }
}
