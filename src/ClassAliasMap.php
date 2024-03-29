<?php

/*
 * @package     Extly Infrastructure Support
 *
 * @author      Extly, CB. <team@extly.com>
 * @copyright   Copyright (c)2012-2024 Extly, CB. All rights reserved.
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 *
 * @see         https://www.extly.com
 */

// Aliases only to be used with the PHP-Prefixer

if (class_exists('XTP_BUILD\Extly\CMS\Document\Renderer\Html\XTHtmlAssetsBodyRenderer')) {
    class_alias(
        XTP_BUILD\Extly\CMS\Document\Renderer\Html\XTHtmlAssetsBodyRenderer::class,
        'Joomla\CMS\Document\Renderer\Html\XTHtmlAssetsBodyRenderer'
    );

    class_alias(
        XTP_BUILD\Extly\CMS\Document\Renderer\Html\XTHtmlAssetsRenderer::class,
        'Joomla\CMS\Document\Renderer\Html\XTHtmlAssetsRenderer'
    );

    return;
}

class_alias(
    Extly\CMS\Document\Renderer\Html\XTHtmlAssetsBodyRenderer::class,
    'Joomla\CMS\Document\Renderer\Html\XTHtmlAssetsBodyRenderer'
);

class_alias(
    Extly\CMS\Document\Renderer\Html\XTHtmlAssetsRenderer::class,
    'Joomla\CMS\Document\Renderer\Html\XTHtmlAssetsRenderer'
);
