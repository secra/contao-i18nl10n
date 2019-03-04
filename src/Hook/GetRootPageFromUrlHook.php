<?php

namespace Verstaerker\I18nl10nBundle\Hook;

use Contao\Config;
use Verstaerker\I18nl10nBundle\Classes\I18nl10n;

/**
 * Class GetRootPageFromUrlHook
 *
 * @package Verstaerker\I18nl10nBundle\Hook
 *
 * https://docs.contao.org/books/api/extensions/hooks/getRootPageFromUrl.html
 */
class GetRootPageFromUrlHook
{
    /**
     *
     * @return null
     */
    public function getRootPageFromUrl()
    {
        $arrLanguages = I18nl10n::getInstance()->getLanguagesByDomain();

        // If no root pages found, return
        if (!count($arrLanguages)) {
            return null;
        }

        // Get default language
        $strLanguage = $arrLanguages['default'];

        // find out if the browser likes German, if not - redirect to english homepage
        $accept_language = \Environment::get('httpAcceptLanguage') ?: array();

        if (in_array($strLanguage, $accept_language)) {
            \Input::setGet('language', $strLanguage);
        } else {
            switch (Config::get("i18nl10n_urlParam")) {
                case 'parameter':
                    $redirect = '/?language=en';
                    break;
                default:
                    $redirect = '/en/index.html';
            }

            \Controller::redirect($redirect, 302);
            exit;
        }

        return null;
    }
}
