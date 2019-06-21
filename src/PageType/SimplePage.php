<?php

namespace JDolba\Chapters\PageType;

use SilverStripe\CMS\Model\SiteTree;

class SimplePage extends \Page
{
    private static $table_name = BookPage::PAGE_TYPES_TABLE_NAME_PREFIX . 'SimplePage';

    private static $singular_name = 'Book Simple page';
    private static $plural_name = 'Book Simple page\'s';

    private static $can_be_root = false;

    private static $allowed_children = [
        self::class,
    ];

    private static $has_one = [
        'BookPage' => BookPage::class,
    ];

    private static $db = [

    ];

    public function validate()
    {
        $result = parent::validate();

        if (in_array($this->Parent()->ClassName, [self::class, BookPage::class], true)) {
            $result->addError(
                sprintf(
                    '%s could be only child of Book itself or Simple Book Page',
                    $this->singular_name()
                )
            );
        }

        return $result;
    }

    protected function onBeforeWrite()
    {
        parent::onBeforeWrite();

        $this->BookPage = $this->getParentBookPage();
    }

    /**
     * @return \JDolba\Chapters\PageType\BookPage
     */
    private function getParentBookPage() {
        $parent = $this->Parent();

        while ($parent->ClassName !== BookPage::class) {
            $parent = $parent->Parent();
        }

        return $parent;
    }
}
