<?php

namespace App\Markdown;

use DomainException;
use Highlight\Highlighter;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\CommonMark\Util\Xml;

/**
 * Custom FencedCode renderer that uses scrivo/highlight.php
 * for server-side syntax highlighting.
 */
final class HighlightedFencedCodeRenderer implements NodeRendererInterface
{
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): \Stringable
    {
        FencedCode::assertInstanceOf($node);

        $code = $node->getLiteral();
        $infoWords = $node->getInfoWords();
        $language = $infoWords[0] ?? null;

        try {
            $highlighter = new Highlighter();

            if ($language) {
                $result = $highlighter->highlight($language, $code);
            } else {
                $result = $highlighter->highlightAuto($code);
            }

            $codeAttrs = ['class' => 'hljs ' . $result->language];

            return new HtmlElement(
                'pre',
                [],
                new HtmlElement('code', $codeAttrs, $result->value)
            );
        } catch (DomainException $e) {
            // Fallback to plain code if language not supported
            $attrs = $node->data->getData('attributes');

            if ($language !== null && $language !== '') {
                $attrs->append('class', 'language-' . $language);
            }

            return new HtmlElement(
                'pre',
                [],
                new HtmlElement('code', $attrs->export(), Xml::escape($code))
            );
        }
    }
}
