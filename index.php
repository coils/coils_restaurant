<?php
/**
 * index.php
 * 
 * Restoracio トップページ
 * 
 * @copyright (c) 2018 Yuki Tsuji
 */

require_once './require_once/session.php';
require_once './require_once/functions.php';
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="Yuki Tsuji">
        <meta name="description" content="Restoracioは，レストラン情報を検索することが出来るWebアプリケーションです．">
        <meta name="robots" content="noindex, nofollow, noarchive">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./css/restoracio.css" rel="stylesheet">
        <title>Restoracio</title>
    </head>
    <body>

        <script>
            // 現在地取得処理
            function getPosition() {
                // 現在地を取得
                navigator.geolocation.getCurrentPosition(
                    // 取得成功した場合，緯度と経度のフォームに現在位置の座標を入力
                    function(position) {
                        document.getElementById("latitude").value = position.coords.latitude;
                        document.getElementById("longitude").value = position.coords.longitude;
                    },
                    // 取得失敗した場合，エラー表示
                    function(error) {
                        switch(error.code) {
                            case 1: // PERMISSION_DENIED
                                alert("位置情報の利用が許可されていません．");
                                break;
                            case 2: // POSITION_UNAVAILABLE
                                alert("現在位置が取得できませんでした．");
                                break;
                            case 3: // TIMEOUT
                                alert("タイムアウトになりました．");
                                break;
                            default:
                                alert("その他のエラー(エラーコード:"+error.code+")");
                                break;
                        }
                    }
                );
            }
        </script>

        <div class="word_wrap">

            <h1>Restoracio</h1>

            <fieldset>
            <legend>Restoracioへようこそ</legend>
            <p>
                Restoracioは，レストラン情報を検索することが出来るWebアプリケーションです．
            </p>
            </fieldset>

            <br />

            <?php if ($_SESSION['search_criteria'] === 'search_criteria'): ?>
                <fieldset>
                <legend>位置情報取得</legend>
                <p>
                    位置情報取得ボタンを押すと，緯度と経度のフォームに現在位置の座標が入力されます．
                </p>
                <div style="text-align: center;">
                    <button onclick="getPosition();" class="gray_button">位置情報取得</button>
                </div>
                </fieldset>
                <br />
            <?php endif; ?>

            <fieldset>
            <legend>検索条件入力フォーム</legend>
            <div style="text-align: center;">
                <form action="search_result_list.php" method="GET">
                    <p>
                        <label for="freeword">検索ワード</label><br />
                        <input type="text" name="freeword" id="freeword" class="form" size="50" maxlength="100" value="<?php echo h(filter_input(INPUT_GET, 'freeword')); ?>">
                    </p>
                    <?php if ($_SESSION['search_criteria'] === 'search_criteria'): ?>
                        <p>
                            <label for="latitude">緯度</label><br />
                            <input type="text" name="latitude" id="latitude" class="form" size="50" maxlength="100" value="<?php echo h(filter_input(INPUT_GET, 'latitude')); ?>">
                        </p>
                        <p>
                            <label for="longitude">経度</label><br />
                            <input type="text" name="longitude" id="longitude" class="form" size="50" maxlength="100" value="<?php echo h(filter_input(INPUT_GET, 'longitude')); ?>">
                        </p>
                        <p>
                            <label for="range">範囲(半径)</label><br />
                            <select id="range" name="range">
                                <option value="1">300m</option>
                                <option value="2">500m</option>
                                <option value="3" selected>1km</option>
                                <option value="4">2km</option>
                                <option value="5">3km</option>
                            </select>
                        </p>
                    <?php endif; ?>
                    <p>
                        <button type="submit" class="gray_button">検索</button>
                    </p>
                </form>
                <?php if ($_SESSION['search_criteria'] === 'search_criteria'): ?>
                    <form action="" name="back_search_criteria" method="POST">
                        <input type="hidden" name="back_search_criteria" value="">
                        <a href="javascript:back_search_criteria.submit()">元に戻す</a>
                    </form>
                <?php else: ?>
                    <form action="" name="search_criteria" method="POST">
                        <input type="hidden" name="search_criteria" value="">
                        <a href="javascript:search_criteria.submit()">詳細な検索条件</a>
                    </form>
                <?php endif; ?>
            </div>
            </fieldset>

            <br />

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
