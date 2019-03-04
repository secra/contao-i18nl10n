<?php

namespace Verstaerker\I18nl10nBundle\Hook;

use Contao\Config;
use Contao\Database;
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

            $db = Database::getInstance();

            $sql   = <<<SQL
            SELECT c.*
            FROM tl_page a
            LEFT JOIN tl_page b ON a.id=b.pid
            LEFT JOIN tl_page_i18nl10n c ON c.pid=b.id
            WHERE a.dns = ?
              and a.type = 'root'
             and c.language = ?
            ORDER BY b.sorting
            LIMIT 1
SQL;

            $query = $db->prepare($sql)->execute($_SERVER["SERVER_NAME"], "en");

            if ($row = $query->fetchAssoc()) {
                $redirect = null;
                switch (Config::get("i18nl10n_urlParam")) {
                    case 'parameter':
                        $redirect = "?language=en";
                        break;
                    default:
                        $redirect = "en/index.html";
                }

                \Controller::redirect("/${row["alias"]}/${redirect}", 302);
                exit;
            }
        }

        return null;
    }
}
