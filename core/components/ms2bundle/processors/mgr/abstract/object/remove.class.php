<?php

abstract class ms2bundleRemoveProcessor extends modObjectRemoveProcessor
{
    /** @var array */
    public $languageTopics = array('ms2bundle:default');

    /** @var string */
    public $objectType = 'ms2bundle';
}