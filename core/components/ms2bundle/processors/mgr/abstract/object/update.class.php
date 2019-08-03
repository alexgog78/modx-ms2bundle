<?php

abstract class ms2bundleUpdateProcessor extends modObjectUpdateProcessor
{
    /** @var array */
    public $languageTopics = array('ms2bundle:default');

    /** @var string */
    public $objectType = 'ms2bundle';

    /**
     * @return mixed
     */
    public function beforeSet()
    {
        //Combo-boolean
        $boolean = array('active');
        foreach ($boolean as $tmp) {
            if ($this->getProperty($tmp) == $this->modx->lexicon('yes') || $this->getProperty($tmp) == 1) {
                $this->setProperty($tmp, true);
            } else {
                $this->setProperty($tmp, false);
            }
        }

        return parent::beforeSet();
    }


    /**
     * @return bool
     */
    public function beforeSave()
    {
        if (!$this->validateRequiredFields()) {
            return false;
        }
        if (!$this->validateUniqueFields()) {
            return false;
        }

        return parent::beforeSave();
    }

    /**
     * @return bool
     */
    private function validateRequiredFields()
    {
        foreach ($this->object::REQUIRED_FIELDS as $tmp) {
            $property = $this->getProperty($tmp);
            if (is_array($property)) {
                $property = array_filter($property, 'strlen');
            }

            if (empty($property)) {
                if (is_array($property)) {
                    $tmp .= '[]';
                }
                $this->addFieldError($tmp, $this->modx->lexicon('field_required'));
                return false;
            }
        }
        return true;
    }

    /**
     * @return bool
     */
    private function validateUniqueFields()
    {
        foreach ($this->object::UNIQUE_FIELDS as $tmp) {
            $checkQuery = array(
                $tmp => $this->getProperty($tmp)
            );

            if ($this->object instanceof xPDOSimpleObject) {
                $checkQuery['id:!='] = $this->getProperty('id');
            }

            if (!empty($this->object::UNIQUE_FIELDS_CHECK_BY_CONDITIONS)) {
                foreach ($this->object::UNIQUE_FIELDS_CHECK_BY_CONDITIONS as $key => $value) {
                    $checkQuery[$key] = $this->getProperty($value);
                }
            }

            if ($this->modx->getCount($this->classKey, $checkQuery)) {
                $this->addFieldError($tmp, $this->modx->lexicon('ms2bundle_err_ae'));
                return false;
            }
        }
        return true;
    }
}