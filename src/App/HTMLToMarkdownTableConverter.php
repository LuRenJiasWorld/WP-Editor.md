<?php

namespace EditormdApp;

use League\HTMLToMarkdown\Converter\ConverterInterface;
use League\HTMLToMarkdown\ElementInterface;

class HTMLToMarkdownTableConverter implements ConverterInterface
{
    /**
     * @param ElementInterface $element
     *
     * @return string
     */
    public function convert(ElementInterface $element)
    {
        switch ($element->getTagName()) {
            case 'tr':
                $line = [];
                $i = 1;
                foreach ($element->getChildren() as $td) {
                    $i++;
                    $v = $td->getValue();
                    $v = trim($v);
                    if ($i % 2 === 0 || $v !== '') {
                        $line[] = $v;
                    }
                }
                return '| ' . implode(' | ', $line) . " |\n";

            case 'td':
            case 'th':
                return trim($element->getValue());

            case 'tbody':
                return trim($element->getValue());

            case 'thead':
                $headerLine = reset($element->getChildren())->getValue();
                $headers = explode(' | ', trim(trim($headerLine, "\n"), '|'));

                $hr = [];
                foreach ($headers as $td) {
                    $length = strlen(trim($td)) + 2;
                    $hr[] = str_repeat('-', $length > 3 ? $length : 3);
                }
                $hr = '|' . implode('|', $hr) . '|';

                return $headerLine . $hr . "\n";
            case 'table':
                $inner = $element->getValue();
                if (strpos($inner, '-----') === false) {
                    $inner = explode("\n", $inner);
                    $single = explode(' | ', trim($inner[0], '|'));
                    $hr = [];
                    foreach ($single as $td) {
                        $length = strlen(trim($td)) + 2;
                        $hr[] = str_repeat('-', $length > 3 ? $length : 3);
                    }
                    $hr = '|' . implode('|', $hr) . '|';
                    array_splice($inner, 1, 0, $hr);
                    $inner = implode("\n", $inner);
                }
                return trim($inner) . "\n\n";
        }
        return $element->getValue();
    }

    /**
     * @return string[]
     */
    public function getSupportedTags()
    {
        return array('table', 'tr', 'thead', 'td', 'tbody');
    }
}