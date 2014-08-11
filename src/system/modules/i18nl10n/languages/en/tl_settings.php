<?php

/**
 * i18nl10n Contao Module
 *
 * The i18nl10n module for Contao allows you to manage multilingual content
 * on the element level rather than with page trees.
 *
 *
 * PHP version 5
 * @copyright   Verstärker, Patric Eberle 2014
 * @copyright   Krasimir Berov 2010-2013
 * @author      Patric Eberle <line-in@derverstaerker.ch>
 * @author      Krasimir Berov
 * @package     i18nl10n
 * @license     LGPLv3 http://www.gnu.org/licenses/lgpl-3.0.html
 */

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_settings']['page_i18nl10n'] = 'Multilingual pages (i18nl10n)';

$GLOBALS['TL_LANG']['tl_settings']['i18nl10n_languages'] = array
(
    'Site Languages',
    'Please add <a target="_blank" href="http://en.wikipedia.org/wiki/List_of_ISO_639-1_codes">'
    . '<em>valid ISO 639-1</em></a> language codes(e.g. <em>en</em> or <em>bg</em>) '
    . 'Add only those which you want to support. The default language <strong>must</strong> also be added here.'
);

$GLOBALS['TL_LANG']['tl_settings']['i18nl10n_default_language'] = array
(
    'Default Language',
    'This is the language of your root page and the default language used by i18nl10n.'
);

$GLOBALS['TL_LANG']['tl_settings']['i18nl10n_alias_suffix'] = array
(
    'Use language as alias suffix',
    'The corresponding language will be appended  on the fly to the current page alias '
    . '(e.g. home -&gt; home.en,home.de etc.). The page language will be guessed from it too. '
    . 'URL suffix will be appended after it (e.g. home.en.html). '
    . 'Note! This will change dynamically generated links in menus, but not your page aliases. '
    . 'You can always switch it off.'
);

$GLOBALS['TL_LANG']['tl_settings']['i18nl10n_addLanguageToUrl'] = array
(
    'Add the language to the URL',
    'Add the language string as first URL parameter (e.g. <em>http://domain.tld/en/</em>). '
    . 'Works the same way as the core feature <em>"Add the language to the URL"</em>. '
    . 'Note!: If you enable this, the core feature and <em>"'
    . $GLOBALS['TL_LANG']['tl_settings']['i18nl10n_alias_suffix'][0]
    . '"</em> <em>must</em> be disabled!'
);

$GLOBALS['TL_LANG']['tl_settings']['i18nl10n_alwaysShowL10n'] = array
(
    'Show l10n\'s by default',
    'Always show translation icons and functions for every element in list views'
);

$GLOBALS['TL_LANG']['tl_settings']['i18nl10n_alias_suffixError'] =
    'It\'s not possible to use <em>"%s"</em> and <em>"%s"</em> at the same time. Please only select one!';

$GLOBALS['TL_LANG']['tl_settings']['i18nl10n_contaoAddLanguageToUrlError'] =
    'I18nl10n does not support the <em>"%s"</em> feature of Contao. Please us the module alternative instead.';

$GLOBALS['TL_LANG']['tl_settings']['i18nl10n_defLangMissingError'] =
    'Default language is not present in the list of supported languages. Please add it!';