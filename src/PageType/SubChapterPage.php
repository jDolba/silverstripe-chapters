<?php

namespace JDolba\Chapters\PageType;

use SilverStripe\CMS\Model\SiteTree;

class SubChapterPage extends \Page
{
    private static $table_name = BookPage::PAGE_TYPES_TABLE_NAME_PREFIX . 'SubChapterPage';

    private static $singular_name = 'Book Sub-Chapter';
    private static $plural_name = 'Book Sub-Chapter\'s';

    private static $can_be_root = false;

    private static $allowed_children = [];

    private static $has_one = [
        'ChapterPage' => ChapterPage::class,
    ];

    private static $db = [
    ];

    public function validate()
    {
        $result = parent::validate();

        if ($this->Parent()->ClassName !== ChapterPage::class) {
            $result->addError(
                sprintf(
                    '%s could be only child of Chapter',
                    $this->singular_name()
                )
            );
        }

        return $result;
    }

    /**
     * @return \JDolba\Chapters\PageType\ChapterPage
     */
    private function getParentChapter() {
        return $this->Parent();
    }
}
