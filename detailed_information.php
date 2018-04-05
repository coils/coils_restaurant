<?php
/**
 * detailed_information.php
 * 
 * 店舗詳細情報ページ
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
        <meta name="description" content="店舗詳細情報">
        <meta name="robots" content="noindex, nofollow, noarchive">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./css/restoracio.css" rel="stylesheet">
        <title>店舗詳細情報</title>
    </head>
    <body>

        <div class="word_wrap">

            <form action="search_result_list.php" method="GET">
                <input type="hidden" name="freeword" id="freeword" maxlength="100" value="<?php echo h(filter_input(INPUT_GET, 'freeword')); ?>">
                <input type="hidden" name="latitude" id="latitude" maxlength="100" value="<?php echo h(filter_input(INPUT_GET, 'latitude')); ?>">
                <input type="hidden" name="longitude" id="longitude" maxlength="100" value="<?php echo h(filter_input(INPUT_GET, 'longitude')); ?>">
                <input type="hidden" name="range" id="range" maxlength="100" value="<?php echo h(filter_input(INPUT_GET, 'range')); ?>">
                <button type="submit">検索結果一覧</button>
            </form>

            <h1>店舗詳細情報</h1>

            <div>
                <?php if (isset($restaurants->error)): ?>
                    <div>
                        <p><?php echo $restaurants->error->code; ?></p>
                        <p><?php echo $restaurants->error->message; ?></p>
                    </div>
                <?php elseif ($restaurants->total_hit_count == 1): ?>
                    <table class="type2" align="center">
                        <tr>
                            <th>画像</th>
                        </tr>
                        <tr>
                            <td>
                                <div style="text-align: center;">
                                    <img src="<?php echo h($restaurants->rest->image_url->shop_image1); ?>">
                                    <img src="<?php echo h($restaurants->rest->image_url->shop_image2); ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>店舗名</th>
                        </tr>
                        <tr>
                            <td>
                                <?php echo h($restaurants->rest->name); ?><br />
                                <a href="<?php echo h($restaurants->rest->url); ?>">ぐるなび店舗ページ</a>
                            </td>
                        </tr>
                        <tr>
                            <th>店舗名(カタカナ)</th>
                        </tr>
                        <tr>
                            <td><?php echo h($restaurants->rest->name_kana); ?></td>
                        </tr>
                        <tr>
                            <th>カテゴリー</th>
                        </tr>
                        <tr>
                            <td><?php echo h($restaurants->rest->category); ?></td>
                        </tr>
                        <tr>
                            <th>PR文</th>
                        </tr>
                        <tr>
                            <td><?php echo h($restaurants->rest->pr->pr_short); ?></td>
                        </tr>
                        <tr>
                            <th>営業時間</th>
                        </tr>
                        <tr>
                            <td><?php echo h($restaurants->rest->opentime); ?></td>
                        </tr>
                        <tr>
                            <th>休業日</th>
                        </tr>
                        <tr>
                            <td><?php echo h($restaurants->rest->holiday); ?></td>
                        </tr>
                        <tr>
                            <th>平均予算(円)</th>
                        </tr>
                        <tr>
                            <td><?php echo h($restaurants->rest->budget); ?></td>
                        </tr>
                        <tr>
                            <th>電話番号</th>
                        </tr>
                        <tr>
                            <td><?php echo h($restaurants->rest->tel); ?></td>
                        </tr>
                        <tr>
                            <th>アクセス</th>
                        </tr>
                        <tr>
                            <td>
                                <?php echo h($restaurants->rest->access->line) ?><br />
                                <?php echo h($restaurants->rest->access->station) ?><br />
                                <?php echo h($restaurants->rest->access->walk) ?>分<br />
                                <?php echo h($restaurants->rest->access->note); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>住所</th>
                        </tr>
                        <tr>
                            <td><?php echo h($restaurants->rest->address); ?></td>
                        </tr>
                    </table>
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
