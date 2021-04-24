<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKataTest\Algorithm;

use CodelyTV\FinderKata\Algorithm\Finder;
use CodelyTV\FinderKata\Algorithm\Choice;
use CodelyTV\FinderKata\Algorithm\Person;
use PHPUnit\Framework\TestCase;

final class FinderTest extends TestCase
{
    /** @var Person */
    private $sue;

    /** @var Person */
    private $greg;

    /** @var Person */
    private $sarah;

    /** @var Person */
    private $mike;

    protected function setUp() : void
    {
        $this->sue            = new Person();
        $this->sue->name      = "Sue";
        $this->sue->birth_date = new \DateTime("1950-01-01");

        $this->greg            = new Person();
        $this->greg->name      = "Greg";
        $this->greg->birth_date = new \DateTime("1952-05-01");

        $this->sarah            = new Person();
        $this->sarah->name      = "Sarah";
        $this->sarah->birth_date = new \DateTime("1982-01-01");

        $this->mike            = new Person();
        $this->mike->name      = "Mike";
        $this->mike->birth_date = new \DateTime("1979-01-01");
    }

    /** @test */
    //    public function should_return_empty_when_given_empty_list()


    // Convention of test name being used
    // ............  MethodName_StateUnderTest_ExpectedBehavior

    public function findMinAgeDifferencePersons_GivenEmptyList_ReturnEmpty()
    {
        $list   = [];
        $finder = new Finder($list);

        $result = $finder->find(Choice::MIN_DIFF);

        $this->assertEquals(null, $result->person1);
        $this->assertEquals(null, $result->person2);
    }

    /** @test */

    //should return empty when given one person
    public function findMinAgeDifferencePersons_GivenOnePerson_ReturnEmpty()
    {
        $list   = [];
        $list[] = $this->sue;
        $finder = new Finder($list);

        $result = $finder->find(Choice::MIN_DIFF);

        $this->assertEquals(null, $result->person1);
        $this->assertEquals(null, $result->person2);
    }

    /** @test */
    //should return closest two for two people
    public function findMinAgeDifferencePersons_Given2Persons_ClosestTwoPersons()
    {
        $list   = [];
        $list[] = $this->sue;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(Choice::MIN_DIFF);

        $this->assertEquals($this->sue, $result->person1);
        $this->assertEquals($this->greg, $result->person2);
    }

    /** @test */
    //should return furthest two for two people
    public function findMaxAgeDifferencePersons_Given2Persons_FurthestTwoPersons()
    {
        $list   = [];
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(Choice::MAX_DIFF);

        $this->assertEquals($this->greg, $result->person1);
        $this->assertEquals($this->mike, $result->person2);
    }

    /** @test */
    // should return furthest two for four people
    public function findMaxAgeDifferencePersons_Given4Persons_FurthestTwoPersons()
    {
        $list   = [];
        $list[] = $this->sue;
        $list[] = $this->sarah;
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(Choice::MAX_DIFF);

        $this->assertEquals($this->sue, $result->person1);
        $this->assertEquals($this->sarah, $result->person2);
    }

    /**
     * @test
     */
    //should return closest two for four people
    public function findMinAgeDifferencePersons_Given4Persons_ClosestTwoPersons()
    {
        $list   = [];
        $list[] = $this->sue;
        $list[] = $this->sarah;
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(Choice::MIN_DIFF);

        $this->assertEquals($this->sue, $result->person1);
        $this->assertEquals($this->greg, $result->person2);
    }
}
