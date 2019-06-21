<?php

namespace JDolba\Chapters\PageType;

use SilverStripe\CMS\Model\SiteTree;

class TableOfContentPage extends \Page
{
    private static $table_name = BookPage::PAGE_TYPES_TABLE_NAME_PREFIX . 'TableOfContentPage';

    private static $singular_name = 'Book Table of Contents';
    private static $plural_name = 'Book Table of Contents';

    private static $can_be_root = false;

    private static $allowed_children = [];

    private static $has_one = [
        'BookPage' => BookPage::class,
    ];

    private static $db = [

    ];

    public function validate()
    {
        $result = parent::validate();

        if ($this->Parent()->ClassName !== BookPage::class) {
            $result->addError(
                sprintf(
                    '%s could be only child of Book',
                    $this->singular_name()
                )
            );
        }

        return $result;
    }

    /**
     * @return \JDolba\Chapters\PageType\BookPage
     */
    private function getParentBookPage() {
        return $this->Parent();
    }

    protected function onBeforeWrite()
    {
        parent::onBeforeWrite();

        $this->BookPage = $this->getParentBookPage();
    }

    public function Content() {
        $book = $this->getParentBookPage();

        $content = '<ul>';
        foreach ($book->liveChildren() as $bookPage) {
            /** @var $bookPage SiteTree */
            $content .= sprintf(
                '<li><a href="%s">%s%s</a></li>', $bookPage->Link(),
                $bookPage->getClassName() === ChapterPage::class ? $bookPage->Numbering . ' ' : '' ,
                $bookPage->getTitle()
            );
        }

        return $content .'</ul>';
    }
}
