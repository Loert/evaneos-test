<?php

namespace App\Manager;

use App\Entity\Template;
use App\Entity\Quote;
use App\Entity\User;
use App\Repository\SiteRepository;
use App\Repository\DestinationRepository;
use RuntimeException;
use App\ApplicationContext;

/**
 * Class TemplateManager
 */
class TemplateManager
{
    /**
     * @param Template|null $template
     * @param array $data
     * @return Template
     */
    public function getTemplateComputed(?Template $template, array $data): Template
    {
        if (!$template) {
            throw new RuntimeException('No template given');
        }

        $computedTemplate = clone($template);
        $computedTemplate->subject = $this->computeText($computedTemplate->subject, $data);
        $computedTemplate->content = $this->computeText($computedTemplate->content, $data);

        return $computedTemplate;
    }

    /**
     * @param string $text
     * @param array $data
     * @return string
     */
    private function computeText(string $text, array $data): string
    {
        $applicationContext = ApplicationContext::getInstance();

        $quote = (isset($data['quote']) and $data['quote'] instanceof Quote) ? $data['quote'] : null;

        if ($quote) {
            $site = SiteRepository::getInstance()->getById($quote->siteId);
            $destination = DestinationRepository::getInstance()->getById($quote->destinationId);

            $this->replaceText('[quote:summary_html]', Quote::renderHtml($quote), $text);
            $this->replaceText('[quote:summary]', Quote::renderText($quote), $text);
            $this->replaceText('[quote:destination_name]', $destination->countryName, $text);
        }

        if (isset($destination)) {
            $replaceData = $site->url . '/' . $destination->countryName . '/quote/' . $quote->id;
            $this->replaceText('[quote:destination_link]', $replaceData, $text);
        } else {
            $this->replaceText('[quote:destination_link]', '', $text);
        }

        $user = (isset($data['user']) && $data['user'] instanceof User)
            ? $data['user']
            : $applicationContext->getCurrentUser();

        if ($user) {
            $this->replaceText('[user:first_name]', $user->getFirstname(), $text);
        }

        return $text;
    }

    /**
     * @param string $key
     * @param string $value
     * @param $text
     */
    private function replaceText(string $key, string $value, string &$text): void
    {
        if (strpos($text, $key) !== false && $text !== null && strlen($text) > 0) {
            $text = str_replace($key, $value, $text);
        }
    }
}
