<?php

namespace App\Markdown;

use DomainException;
use Highlight\Highlighter;
use League\CommonMark\Extension\CommonMark\Node\Block\IndentedCode;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\CommonMark\Util\Xml;

/**
 * Custom IndentedCode renderer that uses scrivo/highlight.php
 * for server-side syntax highlighting with auto-detection.
 */
final class HighlightedIndentedCodeRenderer implements NodeRendererInterface
{
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): \Stringable
    {
        IndentedCode::assertInstanceOf($node);

        $code = $node->getLiteral();

        try {
            $highlighter = new Highlighter();
            $result = $highlighter->highlightAuto($code);

            $codeAttrs = ['class' => 'hljs ' . $result->language];

            return new HtmlElement(
                'pre',
                [],
                new HtmlElement('code', $codeAttrs, $result->value)
            );
        } catch (DomainException $e) {
            // Fallback to plain code
            $attrs = $node->data->getData('attributes');

            return new HtmlElement(
                'pre',
                [],
                new HtmlElement('code', $attrs->export(), Xml::escape($code))
            );
        }
    }
}
