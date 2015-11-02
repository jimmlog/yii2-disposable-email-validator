<?php

/**
 * @link https://github.com/jimmlog/yii2-disposable-email-validator/
 * @copyright Copyright (c) 2015 Jimm Logan
 * @license MIT
 */

namespace jimmlog\yii2;

use yii\validators\Validator;

/**
 * DisposableEmailValidator validates that the valid email address is not in a disposable domain list.
 *
 * @package jimmlog\yii2
 */
class DisposableEmailValidator extends Validator
{
    /**
     * @inheritdoc
     */
    public $message;

    protected $disposableDomains;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->enableClientValidation = false;
        if ($this->message === null) {
            $message = 'There are an error with your {attribute}.'.
                ' We do not allow using our platform by anonymous and temporarily email services,'.
                ' please use real email to continue. Thanks\' a lot';
            $this->message = \Yii::t('yii', $message);
        }
        $domainsSource = \Yii::getAlias('@vendor') . DIRECTORY_SEPARATOR .
            'nojacko' . DIRECTORY_SEPARATOR .
            'email-data-disposable' . DIRECTORY_SEPARATOR .
            'data' . DIRECTORY_SEPARATOR .
            'disposable.php';
        if (!empty($domainsSource) && file_exists($domainsSource) && is_readable($domainsSource)) {
            $this->disposableDomains = require_once $domainsSource;
        }
        if (!is_array($this->disposableDomains) || empty($this->disposableDomains)) {
            $this->disposableDomains = [];
        }
    }

    /**
     * @inheritdoc
     */
    protected function validateValue($value)
    {
        $valid = true;
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $domain = array_pop(explode('@', $value));
            if (!empty($domain)) {
                $valid = !in_array($domain, $this->disposableDomains);
            }
        }

        return $valid ? null : [$this->message, []];
    }
}
