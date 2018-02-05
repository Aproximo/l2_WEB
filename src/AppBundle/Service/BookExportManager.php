<?php

namespace AppBundle\Service;

use AppBundle\Entity\Book;

class BookExportManager
{
    public function  exportToFile(Book $book)
    {
        $text = $book->getTitle . PHP_EOL . $book->getDicription();

    }

}