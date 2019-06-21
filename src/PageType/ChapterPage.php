<?php

namespace JDolba\Chapters\PageType;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\ORM\DB;

class ChapterPage extends \Page
{
    private static $table_name = BookPage::PAGE_TYPES_TABLE_NAME_PREFIX . 'ChapterPage';

    private static $singular_name = 'Book Chapter';
    private static $plural_name = 'Book Chapter\'s';

    private static $can_be_root = false;

    private static $allowed_children = [
        SubChapterPage::class,
    ];

    private static $has_one = [
        'BookPage' => BookPage::class,
    ];

    private static $db = [
        'Numbering' => 'Text',
    ];

    /**
     * @return \JDolba\Chapters\PageType\BookPage
     */
    private function getParentBookPage() {
        return $this->Parent();
    }

    /**
     * @var int
     */
    protected static $currentNumberingIterator = 1;

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

    protected function onBeforeWrite()
    {
        parent::onBeforeWrite();

        $this->BookPage = $this->getParentBookPage();
    }

    public function onAfterWrite()
    {
        parent::onAfterWrite();
        $this->recalculateChaptersNumberingInBook();
    }

    public function onAfterDelete()
    {
        parent::onAfterDelete();
        $this->recalculateChaptersNumberingInBook();
    }

    public function recalculateChaptersNumberingInBook() {
        $bookChapters = self::get()->filter(
            [
                'ParentID' => $this->getParentBookPage()->ID,
                'ClassName' => self::class,
            ]
        )->sort('sort', 'asc');

        DB::query(sprintf('UPDATE %s SET Numbering = \'~\'', self::$table_name));
        $currentNumbering = 1;
        $currentNumberingPublished = 1;
        foreach ($bookChapters as $bookChapter) {
            /** @var $bookChapter \JDolba\Chapters\PageType\ChapterPage */

            DB::query(
                sprintf(
                    'UPDATE %s SET Numbering = \'%s\' WHERE ID = %d ',
                    self::$table_name,
                    $this->formatChapterNumbering($currentNumbering),
                    $bookChapter->ID
                )
            );
            $currentNumbering++;

            if ($bookChapter->isPublished()) {
                DB::query(
                    sprintf(
                        'UPDATE %s_Live SET Numbering = \'%s\' WHERE ID = %d ',
                        self::$table_name,
                        $this->formatChapterNumbering($currentNumberingPublished),
                        $bookChapter->ID
                    )
                );

                $currentNumberingPublished++;
            }
        }
    }

    /**
     * @param int $number
     * @return string
     */
    protected function formatChapterNumbering($number) {
        return sprintf('%d', $number);
    }

    public function Title() {
        return $this->Numbering . ' ' . $this->Title;
    }
}
