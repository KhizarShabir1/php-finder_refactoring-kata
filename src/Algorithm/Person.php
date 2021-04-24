<?php

declare (strict_types = 1);

namespace CodelyTV\FinderKata\Algorithm;

use DateTime;

final class Person
{
    /** @var string */
    //public $name;

    /** @var DateTime */
    //public $birth_date;


    public function __construct(
        public string $name="",
        public ?DateTime $birth_date=null,
    )
    {}

    /**
    Check if person calling this function older than than the $person2
     **/
    public function isOlder(Person $person2): bool
    {
        if ($this->birth_date > $person2->birth_date) {
            return true;
        } else {
            return false;
        }

    }

    /**
    Getting the age difference of persons on $this and $person2
     **/
    public function ageDifference(Person $person2): int
    {
        $age_difference = $this->birth_date->getTimestamp() - $person2->birth_date->getTimestamp();
        return $age_difference;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getBirthDate(): DateTime
    {
        return $this->birth_date;
    }

    public function setBirthDate(DateTime $birth_date)
    {
        $this->birth_date = $birth_date;
    }
}
