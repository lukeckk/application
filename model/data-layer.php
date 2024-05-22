<?php

/*
    This is my data layer.
    It belongs to the Model.
*/

// A function that gets the meals for the Diner app
class DataLayer
{
    static function getLanguage(){
        return array('JavaScript', 'PHP', 'Java', 'Python', 'HTML', 'CSS', 'ReactJS', 'NodeJS');
    }

    static function getIndustry(){
        return array('Saas', 'Health tech', 'Ag tech', 'HR tech', 'Industrial tech', 'Cybersecurity');
    }
}
