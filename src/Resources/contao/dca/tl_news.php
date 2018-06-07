<?php

$GLOBALS['TL_DCA']['tl_news']['list']['sorting']['child_record_callback'] = array('tl_news_l10n', 'listNewsArticles');

/**
 * Class tl_news_l10n
 */
class tl_news_l10n extends tl_news
{
    public function listNewsArticles($arrRow)
    {
        $label = parent::listNewsArticles($arrRow);

        $labelLength = strlen($label);

        if ("</div>" !== substr($label, $labelLength - 6, 6))
        {
            throw new Exception('expected closing div tag at the end of the label');
        }

        return substr($label, 0, $labelLength - 6) . $this->addIcon($arrRow["id"]) . "</div>";
    }

    public function addIcon($newsId)
    {
        $sql = 'SELECT COUNT(id) items, language FROM tl_content WHERE pid = ? AND ptable = "tl_news" GROUP BY language';

        // count content elements in different languages and display them
        $items = \Database::getInstance()
            ->prepare($sql)
            ->execute($newsId)
            ->fetchAllAssoc();

        // build icon elements
        if (! empty($items))
        {
            $label = '';

            foreach ($items as $l10nItem)
            {
                $count          = $l10nItem['items'];
                $title          = $GLOBALS['TL_LANG']['LNG'][$l10nItem['language']] . ": $count";

                if ($l10nItem['language'])
                {
                    $l10nItemIcon = 'bundles/verstaerkeri18nl10n/img/flag_icons/' . $l10nItem['language'] . '.png';
                    $label .= '<img class="i18nl10n_article_flag" title="' . $title . '" src="' . $l10nItemIcon . '" />';
                }

            }

            return $label;
        }

        return false;
    }
}
