<?php

namespace App\Manager;

use App\Entity\Template;
use App\Entity\User;
use App\Service\QuoteService;
use App\Service\UserService;
use RuntimeException;
use App\ApplicationContext;

/**
 * Class TemplateManager
 */
class TemplateManager
{
    /**
     * @var QuoteService
     */
    private $quoteService;

    /**
     * @var UserService
     */
    private $userService;

    /**
     * TemplateManager constructor.
     */
    public function __construct()
    {
        $this->quoteService = new QuoteService(); //Can be replace with dependency injection
        $this->userService = new UserService(); //Can be replace with dependency injection
    }

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

        $template->subject = $this->computeText($template->subject, $data);
        $template->content = $this->computeText($template->content, $data);

        return $template;
    }

    /**
     * @param string $text
     * @param array $data
     * @return string
     */
    private function computeText(string $text, array $data): string
    {
        $text = $this->quoteService->compute($text, $data);
        $text = $this->userService->compute($text, $data);

        return $text;
    }
}
