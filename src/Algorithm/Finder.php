<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Algorithm;

/**
                           Code Execution Graph

  find(MIN_DIFF/MAX_DIFF)  find two persons having minimum/maximum difference in their ages
          │
          ├───────────► if no of persons less than 2 exit()
          │
          │
          │
          │  getAgeDifferenceArray()─────┐            person1, person2
          │                              │  isOlder()───────┐
          │                              │                  │
                                         │◄─────────────────┘
                                         │                        [person1, person2, age_difference] 
                                         │  ageDifference()─┐
                                         │                  │
                                         ◄──────────────────┘
          │                              │                   
          │   ◄──────────────────────────┘
          │   //return of age-differences between eachother
          │  A={ [person1, person2, age_difference],
          │       [person1, person2, age_difference],
          │        [person1, person2, age_difference],
          │         ...
          │       }
          │
 ┌────────┴──────┐
 │               │
 │               │
 │               │
 │               │
 │               │
 │               │if MAX_DIFF
 │               ▼
 │                     return element in the A that has maximum value for age_difference
 ▼
if MIN_DIFF

    return element in A that has minimum value for age_difference

**/


final class Finder
{
    /** @var Person[] */
    private  $persons_array;

    public function __construct(array $persons_array)
    {
        $this->persons_array = $persons_array;
    }

    /** 
        Comparing all the persons in persons_array array and returning an array of "TwoPersonsWithAgeDifference" Type having age difference of all persons
     **/
    public function getAgeDifferencesArray()
    {
        /** @var TwoPersonsWithAgeDifference[] $age_diff_of_persons_arr */
        $age_diff_of_persons_arr = [];
        $no_of_Persons =  count($this->persons_array);

        for ($i = 0; $i < $no_of_Persons; $i++) {
            for ($j = $i + 1; $j < $no_of_Persons; $j++) {
                $personsPair = new TwoPersonsWithAgeDifference();
                /** 
                     Here "if-else" is used to store the younger person in $personsPair->person1 
                     and older person in $personsPair->person1 (required for the tests to work properly).
                 **/
                if ( $this->persons_array[$i]->isOlder( person2: $this->persons_array[$j] ) )
                {
                    $personsPair->age_difference = $this->persons_array[$i]->ageDifference( person2: $this->persons_array[$j]);
                    $personsPair->person1 = $this->persons_array[$j];
                    $personsPair->person2 = $this->persons_array[$i];
                }else
                {
                    $personsPair->age_difference = $this->persons_array[$j]->ageDifference( person2: $this->persons_array[$i]);
                    $personsPair->person1 = $this->persons_array[$i];
                    $personsPair->person2 = $this->persons_array[$j];
                }
                $age_diff_of_persons_arr[] = $personsPair;
            }
        }
        return $age_diff_of_persons_arr;
    }

    /** 
    *   Find two persons having minimum/maximum difference in their ages
    **/
    public function find(int $choice): TwoPersonsWithAgeDifference
    {

        /** 
        *   The persons in the array should be atleast 2 to get the age_differnce
        **/
        if (count($this->persons_array) < 2) {
            echo "\nGiven less than 2 Persons in the persons_array\n";
            return new TwoPersonsWithAgeDifference();
        }

       
        /** @var TwoPersonsWithAgeDifference[] $tr */
        /**
            Getting age difference of all persons with each other 
        **/
        $age_diff_of_persons_arr = $this->getAgeDifferencesArray();

        $answer = $age_diff_of_persons_arr[0];

        /** 
        *    Finding the minimum or maximum age-difference persons in "age_diff_of_persons_arr" 
        **/
        foreach ($age_diff_of_persons_arr as $result) {

            match ($choice) { 
                Choice::MIN_DIFF => ($result->age_difference > $answer->age_difference) ? : ($answer = $result),
                Choice::MAX_DIFF => ($result->age_difference < $answer->age_difference) ? : ($answer = $result), 
            };

        }

        return $answer;
    }
}
