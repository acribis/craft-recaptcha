<?php
/**
 * reCaptcha plugin for Craft CMS
 *
 * @author    acribis AG
 * @copyright Copyright (c) 2018 acribis AG
 * @link      acribis.ch
 * @package   craft-recaptcha
 * @since     0.1.0
 */

namespace Craft;
class RecaptchaPlugin extends BasePlugin
{
    public function getName()
    {
        return Craft::t('Google reCAPTCHA for Craft CMS contact form');
    }

    public function getDescription()
    {
        return 'Displays and validates Google\'s reCaptcha form widget on Pixel & Tonic\'s Contact Form';
    }

    public function getDocumentationUrl()
    {
        return 'https://github.com/acribis/craft-recaptcha/blob/master/README.md';
    }

    public function getReleaseFeedUrl()
    {
        return 'https://raw.githubusercontent.com/acribis/craft-recaptcha/master/releases.json';
    }

    public function getVersion()
    {
        return '0.1.0';
    }

    public function getSchemaVersion()
    {
        return '0.1.0';
    }

    public function getDeveloper()
    {
        return 'acribis AG';
    }

    public function getDeveloperUrl()
    {
        return 'https://acribis.ch';
    }

    public function hasCpSection()
    {
        return false;
    }

    public function init()
    {
        parent::init();

        craft()->on('contactForm.beforeSend', function(ContactFormEvent $event) {
            /** @var \Craft\ContactFormModel $message */
            $message = $event->params['message'];

            $captcha = craft()->request->getPost('g-recaptcha-response');
            $verified = craft()->recaptcha_verify->verify($captcha);

            if (!$verified) {
                $message->addError('recaptcha', Craft::t('Please state that you are not a robot'));
                $event->isValid = false;
            }
        });
    }


    /**
     * Defines the attributes that model your plugin’s available settings.
     *
     * @return array
     */
    protected function defineSettings()
    {
        return array(
            'siteKey' => array(AttributeType::Mixed, 'default' => ''),
            'secretKey' => array(AttributeType::Mixed, 'default' => ''),
        );
    }

    /**
     * Returns the HTML that displays your plugin’s settings.
     *
     * @return mixed
     * @throws Exception
     */
    public function getSettingsHtml()
    {
        return craft()->templates->render('recaptcha/settings', array(
            'settings' => $this->getSettings()
        ));
    }
}
