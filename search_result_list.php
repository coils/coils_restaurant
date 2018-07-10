<?php
/**
 * search_result_list.php
 * 
 * 検索結果一覧ページ
 * 
 * @copyright (c) 2018 Yuki Tsuji
 */

require_once './require_once/functions.php';
require_once './require_once/class/gnavi_api_class.php';

// レストラン検索
$restaurants = Gnavi_api::getRestaurants();
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="Yuki Tsuji">
        <meta name="description" content="検索結果一覧">
        <meta name="robots" content="noindex, nofollow, noarchive">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./css/coils.css" rel="stylesheet">
        <title>検索結果一覧</title>
    </head>
    <body>
        <form action="./" method="GET">
            <input type="hidden" name="freeword" id="freeword" maxlength="100" value="<?php echo h(filter_input(INPUT_GET, 'freeword')); ?>">
            <input type="hidden" name="latitude" id="latitude" maxlength="100" value="<?php echo h(filter_input(INPUT_GET, 'latitude')); ?>">
            <input type="hidden" name="longitude" id="longitude" maxlength="100" value="<?php echo h(filter_input(INPUT_GET, 'longitude')); ?>">
            <input type="hidden" name="range" id="range" maxlength="100" value="<?php echo h(filter_input(INPUT_GET, 'range')); ?>">
            <button type="submit" class="gray_button">トップページ</button>
        </form>
        <div class="word_break">
            <h1>検索結果一覧</h1>
            <div>
                <?php if (isset($restaurants->error)): ?>
                    <div>
                        <p><?php echo h($restaurants->error->code); ?></p>
                        <p><?php echo h($restaurants->error->message); ?></p>
                    </div>
                <?php else: ?>
                    <div>
                        <p>該当件数:<?php echo h($restaurants->total_hit_count); ?>件</p>
                    </div>
                    <table class="type">
                        <thead>
                            <tr>
                                <th>店舗名</th>
                                <th>カテゴリー</th>
                                <th>アクセス</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($restaurants->total_hit_count == 1 || $restaurants->total_hit_count % 10 == 1 && $restaurants->page_offset == ceil($restaurants->total_hit_count / 10)): ?>
                                <tr>
                                    <td>
                                        <?php if (mb_strlen($restaurants->rest->name) >= 1): ?>
                                            <a href="<?php echo h(shop_url($restaurants->rest->id)); ?>"><?php echo h($restaurants->rest->name); ?></a>
                                        <?php else: ?>
                                            <div class="gray_font">
                                                <?php echo h('データが存在しません．'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (mb_strlen($restaurants->rest->category) >= 1): ?>
                                            <?php echo h($restaurants->rest->category); ?>
                                        <?php else: ?>
                                            <div class="gray_font">
                                                <?php echo h('データが存在しません．'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (mb_strlen($restaurants->rest->access->line) >= 1): ?>
                                            <?php echo h($restaurants->rest->access->line); ?><br />
                                            <?php echo h($restaurants->rest->access->station); ?><br />
                                            <?php echo h($restaurants->rest->access->walk); ?>分
                                        <?php else: ?>
                                            <div class="gray_font">
                                                <?php echo h('データが存在しません．'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($restaurants->rest as $rest) : ?>
                                    <tr>
                                        <td>
                                            <?php if (mb_strlen($rest->name) >= 1): ?>
                                                <a href="<?php echo h(shop_url($rest->id)); ?>"><?php echo h($rest->name); ?></a>
                                            <?php else: ?>
                                                <div class="gray_font">
                                                    <?php echo h('データが存在しません．'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if (mb_strlen($rest->category) >= 1): ?>
                                                <?php echo h($rest->category); ?>
                                            <?php else: ?>
                                                <div class="gray_font">
                                                    <?php echo h('データが存在しません．'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if (mb_strlen($rest->access->line) >= 1): ?>
                                                <?php echo h($rest->access->line); ?><br />
                                                <?php echo h($rest->access->station); ?><br />
                                                <?php echo h($rest->access->walk); ?>分
                                            <?php else: ?>
                                                <div class="gray_font">
                                                    <?php echo h('データが存在しません．'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <div>
                        <?php if ($restaurants->total_hit_count <= 1000): ?>
                            <?php echo paging($restaurants->page_offset, $restaurants->total_hit_count); ?>
                        <?php else: ?>
                            <?php echo paging($restaurants->page_offset, 1000); ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <br />
            <div style="text-align: center;">
                <a href="http://api.gnavi.co.jp/api/scope/" target="_blank">
                <img src="http://api.gnavi.co.jp/api/img/credit/api_265_65.gif" width="265" height="65" border="0" alt="グルメ情報検索サイト　ぐるなび">
                </a>
            </div>
            <footer>
                <hr />
                <div class="copyright">
                    <!-- (c) 2018 Yuki Tsuji -->
                    &#169; 2018 Yuki Tsuji
                </div>
            </footer>
        </div>
    </body>
</html>
