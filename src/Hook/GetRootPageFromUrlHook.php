<?php

namespace Verstaerker\I18nl10nBundle\Hook;

use Verstaerker\I18nl10nBundle\Classes\I18nl10n;

/**
 * Class GetRootPageFromUrlHook
 * @package Verstaerker\I18nl10nBundle\Hook
 *
 * Translate root page to the "foreign" version, currently hardcoded to en/index
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
		$blnDebug = true;
		if($_COOKIE["dev"] == 'Markus'){
			$blnDebug = true;
		}
		
		$arrLanguages = I18nl10n::getInstance()->getLanguagesByDomain();

        // If no root pages found, return
        if (!count($arrLanguages)) {
            return null;
        }
		
		// Get default language
        $strLanguage  = $arrLanguages['default'];
		
		// find out if the browser likes German, if not - redirect to english homepage
		$accept_language = \Environment::get('httpAcceptLanguage');
		
		if(in_array($strLanguage, $accept_language)) {	
			\Input::setGet('language', $strLanguage);
		} else {
			\Controller::redirect('/en/index.html', 302);
			exit; exit;
		} 
	
        return null;
    }
}
