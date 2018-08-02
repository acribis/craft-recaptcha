<?php
namespace Craft;

class Recaptcha_RenderService extends BaseApplicationComponent
{
    /**
     * Renders the reCAPTCHA widget
     *
     * @return string
     * @throws Exception
     */
    public function render()
    {
        $plugin = craft()->plugins->getPlugin('recaptcha');
        $settings = $plugin->getSettings();

        $oldTemplatesPath = craft()->path->getTemplatesPath();
        $newTemplatesPath = craft()->path->getPluginsPath().'recaptcha/templates/';
        craft()->path->setTemplatesPath($newTemplatesPath);

        $vars = array(
            'id' => 'gRecaptchaContainer',
            'siteKey' => $settings->attributes['siteKey']
        );

        try {
            $html = craft()->templates->render('frontend/recaptcha.html', $vars);
        } catch (Exception $exception) {
            throw new Exception(Craft::t('An error occurred when rendering the reCAPTCHA widget.'), 500, $exception);
        }

        craft()->path->setTemplatesPath($oldTemplatesPath);

        craft()->templates->includeJsFile('https://www.google.com/recaptcha/api.js');

        return $html;
    }
}
