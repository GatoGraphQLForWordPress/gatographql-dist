<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\Services\MenuPages;

class ExtensionModuleDocumentationMenuPage extends AbstractExtensionModuleDocumentationMenuPage
{
    /**
     * @var \GatoGraphQL\GatoGraphQL\Services\MenuPages\ExtensionsMenuPage|null
     */
    private $extensionsMenuPage;

    final protected function getExtensionsMenuPage(): ExtensionsMenuPage
    {
        if ($this->extensionsMenuPage === null) {
            /** @var ExtensionsMenuPage */
            $extensionsMenuPage = $this->instanceManager->getInstance(ExtensionsMenuPage::class);
            $this->extensionsMenuPage = $extensionsMenuPage;
        }
        return $this->extensionsMenuPage;
    }

    public function getMenuPageSlug(): string
    {
        return $this->getExtensionsMenuPage()->getMenuPageSlug();
    }

    public function getMenuPageTitle(): string
    {
        return $this->getExtensionsMenuPage()->getMenuPageTitle();
    }

    public function isServiceEnabled(): bool
    {
        return $this->getExtensionsMenuPage()->isServiceEnabled();
    }
}
