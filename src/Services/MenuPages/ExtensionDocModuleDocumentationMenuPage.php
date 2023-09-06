<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\Services\MenuPages;

class ExtensionDocModuleDocumentationMenuPage extends AbstractExtensionModuleDocumentationMenuPage
{
    /**
     * @var \GatoGraphQL\GatoGraphQL\Services\MenuPages\ExtensionDocsMenuPage|null
     */
    private $extensionDocsMenuPage;

    final public function setExtensionDocsMenuPage(ExtensionDocsMenuPage $extensionDocsMenuPage): void
    {
        $this->extensionDocsMenuPage = $extensionDocsMenuPage;
    }
    final protected function getExtensionDocsMenuPage(): ExtensionDocsMenuPage
    {
        if ($this->extensionDocsMenuPage === null) {
            /** @var ExtensionDocsMenuPage */
            $extensionDocsMenuPage = $this->instanceManager->getInstance(ExtensionDocsMenuPage::class);
            $this->extensionDocsMenuPage = $extensionDocsMenuPage;
        }
        return $this->extensionDocsMenuPage;
    }

    public function getMenuPageSlug(): string
    {
        return $this->getExtensionDocsMenuPage()->getMenuPageSlug();
    }
}
