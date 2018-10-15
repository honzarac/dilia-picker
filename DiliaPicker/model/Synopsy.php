<?php

namespace DiliaPicker\Model;

class Synopsy
{
    public $name;
    public $nameEn;
    public $detailHref;
    public $author;
    public $literalStarring;
    public $translator;

    public function __construct(
        string $name,
        ?string $nameEn,
        string $detailHref,
        string $author,
        string $literalStarring,
        ?string $translator
    )
    {
        $this->name = $name;
        $this->nameEn = $nameEn;
        $this->detailHref = $detailHref;
        $this->author = $author;
        $this->literalStarring = $literalStarring;
        $this->translator = $translator;
    }
}
