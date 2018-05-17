<?php
/**
 * functions.php
 *
 * 関数
 * 
 * @copyright (c) 2018 Yuki Tsuji
 */

/**
 * XSS対策関数
 * @param string $string
 * @return string
 */
function h($string) {
    return str_replace('&lt;BR&gt;', '<BR>', htmlspecialchars($string, ENT_QUOTES, 'UTF-8'));
}

/**
 * 店舗ID付きのURLを生成する関数
 * @param string $shop_id
 * @return string
 */
function shop_url($shop_id) {
    $uri = "detailed_information.php";
    $id = [
        'id' => $shop_id
    ];
    $url = sprintf("%s?%s", $uri, http_build_query($id));
    return $url;
}

/**
 * ページング
 * @param int $page
 * @param int $total
 * @return string
 */
function paging($page, $total) {
    $delta = 3;
    if ($total < 1) {
        return;
    }
    $query = (is_array(filter_input_array(INPUT_GET))) ? filter_input_array(INPUT_GET) : [];
    if (isset($query['offset_page'])) {
        unset($query['offset_page']);
    }
    $querystring = http_build_query($query);
    $limit = 10;
    $placeholder = "<span><a%s href=\"?offset_page=%d&%s\">%s</a></span> ";

    // 最大ページ数
    $maxPage = ceil($total / $limit);

    $min = max([$page - $delta, 1]);
    $max = min([$page + $delta, $maxPage - 1]);

    $html = '';
    if ($page > 1) {
        $html .= sprintf($placeholder, '', 1, $querystring, '&laquo;');
        $html .= sprintf($placeholder, '', $page - 1, $querystring, '前へ');
    }
    for ($i = $max - 6; $i < $min + 7; $i++) {
        if ($i > -1 && $i < $maxPage) {
            $html .= sprintf($placeholder, ($i == $page - 1) ? ' class="black_font"' : '', $i + 1, $querystring, $i + 1);
        }
    }
    if ($page < $maxPage) {
        $html .= sprintf($placeholder, '', $page + 1, $querystring, '次へ');
        $html .= sprintf($placeholder, '', $maxPage, $querystring, '&raquo;');
    }
    return $html;
}
?>
