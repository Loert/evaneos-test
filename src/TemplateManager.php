<?php

/**
 * Class TemplateManager
 */
class TemplateManager
{
    /**
     * @param Template $tpl
     * @param array $data
     * @return Template
     */
    public function getTemplateComputed(Template $tpl, array $data): Template
    {
        if (!$tpl) {
            throw new RuntimeException('no tpl given');
        }

        $replaced = clone($tpl);
        $replaced->subject = $this->computeText($replaced->subject, $data);
        $replaced->content = $this->computeText($replaced->content, $data);

        return $replaced;
    }

    /**
     * @param $text
     * @param array $data
     * @return mixed
     */
    private function computeText(string $text, array $data)
    {
        $applicationContext = ApplicationContext::getInstance();

        $quote = (isset($data['quote']) and $data['quote'] instanceof Quote) ? $data['quote'] : null;

        if ($quote) {
            $quoteFromRepository = QuoteRepository::getInstance()->getById($quote->id);
            $usefulObject = SiteRepository::getInstance()->getById($quote->siteId);
            $destinationOfQuote = DestinationRepository::getInstance()->getById($quote->destinationId);

            if(strpos($text, '[quote:destination_link]') !== false){
                $destination = DestinationRepository::getInstance()->getById($quote->destinationId);
            }

            $containsSummaryHtml = strpos($text, '[quote:summary_html]');
            $containsSummary = strpos($text, '[quote:summary]');

            if ($containsSummaryHtml !== false) {
                $text = str_replace(
                    '[quote:summary_html]',
                    Quote::renderHtml($quoteFromRepository),
                    $text
                );
            }
            if ($containsSummary !== false) {
                $text = str_replace(
                    '[quote:summary]',
                    Quote::renderText($quoteFromRepository),
                    $text
                );
            }

            (strpos($text, '[quote:destination_name]') !== false) and $text = str_replace('[quote:destination_name]',$destinationOfQuote->countryName,$text);
        }

        if (isset($destination)) {
            $text = str_replace('[quote:destination_link]', $usefulObject->url . '/' . $destination->countryName . '/quote/' . $quoteFromRepository->id, $text);
        }
        else {
            $text = str_replace('[quote:destination_link]', '', $text);
        }

        $user = (isset($data['user']) and ($data['user']  instanceof User)) ? $data['user'] : $applicationContext->getCurrentUser();
        if($user) {
            (strpos($text, '[user:first_name]') !== false) and $text = str_replace('[user:first_name]'       , ucfirst(mb_strtolower($user->firstname)), $text);
        }

        return $text;
    }
}
