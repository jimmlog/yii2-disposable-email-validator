Disposable E-mail validator for Yii 2
=====================================
This library contains validator for block email from disposable domains
with [Yii framework 2.0](http://www.yiiframework.com).

[![Latest Stable Version](https://poser.pugx.org/jimmlog/yii2-disposable-email-validator/v/stable)](https://packagist.org/packages/jimmlog/yii2-disposable-email-validator) 
[![Total Downloads](https://poser.pugx.org/jimmlog/yii2-disposable-email-validator/downloads)](https://packagist.org/packages/jimmlog/yii2-disposable-email-validator) 
[![Latest Unstable Version](https://poser.pugx.org/jimmlog/yii2-disposable-email-validator/v/unstable)](https://packagist.org/packages/jimmlog/yii2-disposable-email-validator) 
[![License](https://poser.pugx.org/jimmlog/yii2-disposable-email-validator/license)](https://packagist.org/packages/jimmlog/yii2-disposable-email-validator)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist jimmlog/yii2-disposable-email-validator
```

or add

```
"jimmlog/yii2-disposable-email-validator": "@stable"
```

to the require section of your composer.json.

How To Use
----------

* Configure the component in your configuration file (web.php). The parameter additionalDomains is optional.

```php
'components' => [
    'disposableEmail' => [
        'class' => 'jimmlog\yii2\DisposableEmail',
        'additionalDomains' => [
            'gmail.com' // for example
        ],
    ],
    ...
```

* Add `DisposableEmailValidator` in your model, for example:
Example of use:

```
    class FormModel extend \yii\base\Model
    {
    ...
        /**
         * @inheritdoc
         */
        public function rules()
        {
        ...
            [['email'], 'email'],
            [['email'], \jimmlog\yii2\DisposableEmailValidator::className()],
        ...
        }
    ...
    }
```

Example with custom message:

```
    class FormModel extend \yii\base\Model
    {
    ...
        /**
         * @inheritdoc
         */
        public function rules()
        {
        ...
            [['email'], 'email'],
            [['email'], \jimmlog\yii2\DisposableEmailValidator::className(), 'message' => 'Please provide another email'],
        ...
        }
    ...
    }
```

License
-------
The MIT License (MIT). See [LICENSE](LICENSE) file.
