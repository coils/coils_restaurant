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

            <button type="button" onclick="history.back()" class="gray_button">戻る</button>

            <h1>店舗詳細情報</h1>

            <div>
                <?php if (isset($restaurants->error)): ?>
                    <div>
                        <p><?php echo h($restaurants->error->code); ?></p>
                        <p><?php echo h($restaurants->error->message); ?></p>
                    </div>
                <?php elseif ($restaurants->total_hit_count == 1): ?>
                    <table class="type2" align="center">
                        <tr>
                            <th>画像</th>
                        </tr>
                        <tr>
                            <td>
                                <?php if (mb_strlen($restaurants->rest->image_url->shop_image1) >= 1 || mb_strlen($restaurants->rest->image_url->shop_image2) >= 1): ?>
                                    <div style="text-align: center;">
                                        <img src="<?php echo h($restaurants->rest->image_url->shop_image1); ?>">
                                        <img src="<?php echo h($restaurants->rest->image_url->shop_image2); ?>">
                                    </div>
                                <?php else: ?>
                                    <div class="gray_font">
                                        <?php echo h('データが存在しません．'); ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>店舗名</th>
                        </tr>
                        <tr>
                            <td>
                                <?php if (mb_strlen($restaurants->rest->name) >= 1): ?>
                                    <?php echo h($restaurants->rest->name); ?><br />
                                    <a href="<?php echo h($restaurants->rest->url); ?>">ぐるなび店舗ページはこちら</a>
                                <?php else: ?>
                                    <div class="gray_font">
                                        <?php echo h('データが存在しません．'); ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>店舗名(カタカナ)</th>
                        </tr>
                        <tr>
                            <td>
                                <?php if (mb_strlen($restaurants->rest->name_kana) >= 1): ?>
                                    <?php echo h($restaurants->rest->name_kana); ?>
                                <?php else: ?>
                                    <div class="gray_font">
                                        <?php echo h('データが存在しません．'); ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>カテゴリー</th>
                        </tr>
                        <tr>
                            <td>
                                <?php if (mb_strlen($restaurants->rest->category) >= 1): ?>
                                    <?php echo h($restaurants->rest->category); ?>
                                <?php else: ?>
                                    <div class="gray_font">
                                        <?php echo h('データが存在しません．'); ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>PR文</th>
                        </tr>
                        <tr>
                            <td>
                                <?php if (mb_strlen($restaurants->rest->pr->pr_short) >= 1): ?>
                                    <?php echo h($restaurants->rest->pr->pr_short); ?>
                                <?php else: ?>
                                    <div class="gray_font">
                                        <?php echo h('データが存在しません．'); ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>営業時間</th>
                        </tr>
                        <tr>
                            <td>
                                <?php if (mb_strlen($restaurants->rest->opentime) >= 1): ?>
                                    <?php echo h($restaurants->rest->opentime); ?>
                                <?php else: ?>
                                    <div class="gray_font">
                                        <?php echo h('データが存在しません．'); ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>休業日</th>
                        </tr>
                        <tr>
                            <td>
                                <?php if (mb_strlen($restaurants->rest->holiday) >= 1): ?>
                                    <?php echo h($restaurants->rest->holiday); ?>
                                <?php else: ?>
                                    <div class="gray_font">
                                        <?php echo h('データが存在しません．'); ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>平均予算(円)</th>
                        </tr>
                        <tr>
                            <td>
                                <?php if (mb_strlen($restaurants->rest->budget) >= 1): ?>
                                    <?php echo h($restaurants->rest->budget); ?>
                                <?php else: ?>
                                    <div class="gray_font">
                                        <?php echo h('データが存在しません．'); ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>電話番号</th>
                        </tr>
                        <tr>
                            <td>
                                <?php if (mb_strlen($restaurants->rest->tel) >= 1): ?>
                                    <?php echo h($restaurants->rest->tel); ?>
                                <?php else: ?>
                                    <div class="gray_font">
                                        <?php echo h('データが存在しません．'); ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>アクセス</th>
                        </tr>
                        <tr>
                            <td>
                                <?php if (mb_strlen($restaurants->rest->access->line) >= 1): ?>
                                    <?php echo h($restaurants->rest->access->line); ?><br />
                                    <?php echo h($restaurants->rest->access->station); ?><br />
                                    <?php echo h($restaurants->rest->access->walk); ?>分<br />
                                    <?php echo h($restaurants->rest->access->note); ?>
                                <?php else: ?>
                                    <div class="gray_font">
                                        <?php echo h('データが存在しません．'); ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>住所</th>
                        </tr>
                        <tr>
                            <td>
                                <?php if (mb_strlen($restaurants->rest->address) >= 1): ?>
                                    <?php echo h($restaurants->rest->address); ?>
                                <?php else: ?>
                                    <div class="gray_font">
                                        <?php echo h('データが存在しません．'); ?>
                                    </div>
                                <?php endif; ?>
                            </td>
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

            <br />

            <div style="text-align: center;">
                <form action="./" name="toppage" method="POST">
                    <a href="javascript:toppage.submit()">トップページ</a>
                </form>
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
