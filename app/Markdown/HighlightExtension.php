<?php

namespace App\Markdown;

use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\ExtensionInterface;

/**
 * CommonMark extension that registers server-side syntax highlighting
 * for fenced code blocks using scrivo/highlight.php.
 */
final class HighlightExtension implements ExtensionInterface
{
    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment->addRenderer(FencedCode::class, new HighlightedFencedCodeRenderer(), 100);
    }
}
