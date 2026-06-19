<?php
/**
 * Site metadata and description generator.
 */

$siteInfo = [
    'title'       => 'Webs PC28',
    'domain'      => 'https://webs-pc28.com',
    'keywords'    => ['加拿大28', '数字预测', '实时数据'],
    'description' => '加拿大28专业数据分享平台',
];

$additionalInfo = [
    'author'        => 'Site Team',
    'language'      => 'zh-CN',
    'charset'       => 'UTF-8',
    'keywords'      => '加拿大28, 加拿大28开奖, 预测',
    'version'       => '2.1',
    'last_updated'  => '2025-03-21',
];

/**
 * Generate a short meta description based on the site info.
 *
 * @param array $info Associative array with keys: title, keywords, description, etc.
 * @return string A concatenated description string.
 */
function generateDescription(array $info): string
{
    $parts = [];

    if (!empty($info['title'])) {
        $parts[] = '站点：' . htmlspecialchars($info['title'], ENT_QUOTES, 'UTF-8');
    }

    if (!empty($info['domain'])) {
        $parts[] = '域名：' . htmlspecialchars($info['domain'], ENT_QUOTES, 'UTF-8');
    }

    if (!empty($info['description'])) {
        $parts[] = '简介：' . htmlspecialchars($info['description'], ENT_QUOTES, 'UTF-8');
    }

    if (!empty($info['keywords'])) {
        $keywordStr = '';
        if (is_array($info['keywords'])) {
            $keywordStr = implode('、', array_map(function($kw) {
                return htmlspecialchars($kw, ENT_QUOTES, 'UTF-8');
            }, $info['keywords']));
        } elseif (is_string($info['keywords'])) {
            $keywordStr = htmlspecialchars($info['keywords'], ENT_QUOTES, 'UTF-8');
        }
        if ($keywordStr !== '') {
            $parts[] = '关键词：' . $keywordStr;
        }
    }

    return implode(' | ', $parts);
}

/**
 * Build a minimal HTML meta block from the site data.
 *
 * @param array $info    Primary site info array.
 * @param array $extra   Extra metadata array.
 * @return string HTML string with meta tags.
 */
function buildMetaBlock(array $info, array $extra = []): string
{
    $lines = [];

    $lines[] = '<meta charset="' . htmlspecialchars($extra['charset'] ?? 'UTF-8', ENT_QUOTES, 'UTF-8') . '">';
    $lines[] = '<meta name="language" content="' . htmlspecialchars($extra['language'] ?? 'zh-CN', ENT_QUOTES, 'UTF-8') . '">';

    if (!empty($info['description'])) {
        $lines[] = '<meta name="description" content="' . htmlspecialchars($info['description'], ENT_QUOTES, 'UTF-8') . '">';
    }

    if (!empty($info['keywords'])) {
        $kw = is_array($info['keywords']) ? implode(',', $info['keywords']) : $info['keywords'];
        $lines[] = '<meta name="keywords" content="' . htmlspecialchars($kw, ENT_QUOTES, 'UTF-8') . '">';
    }

    if (!empty($extra['author'])) {
        $lines[] = '<meta name="author" content="' . htmlspecialchars($extra['author'], ENT_QUOTES, 'UTF-8') . '">';
    }

    if (!empty($extra['version'])) {
        $lines[] = '<meta name="version" content="' . htmlspecialchars($extra['version'], ENT_QUOTES, 'UTF-8') . '">';
    }

    return implode("\n", $lines);
}

// --- Example usage ---
$descriptionText = generateDescription($siteInfo);
echo "生成的描述文本：\n";
echo $descriptionText . "\n\n";

echo "生成的HTML Meta块：\n";
echo buildMetaBlock($siteInfo, $additionalInfo) . "\n";

// Additional test with partial data
$testInfo = [
    'title'       => '加拿大28数据',
    'domain'      => 'https://webs-pc28.com',
    'keywords'    => '加拿大28, 开奖结果',
    'description' => '',
];

echo "\n--- 测试：部分数据 ---\n";
echo generateDescription($testInfo) . "\n";
echo buildMetaBlock($testInfo) . "\n";