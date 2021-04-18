<?php
//データベース定義
define('HOST', 'mysql1.php.xdomain.ne.jp');
define('USR', 'haveabook_user1');
define('PASS', 'waka7ari');
define('DB', 'haveabook_db');

class Hobby_1_2_customM{
    private $cardData = array(
        'cdno' =>array(), 
        'chno' =>array(), 
        'img'  =>array(), 
        'lv' =>array(), 
        'hp' =>array(), 
        'atk'  =>array(), 
        'm1' =>array(), 
        'm2'  =>array(), 
        'm1buf' =>array(), 
        'm2buf' =>array(), 
        'm1lv'  =>array(), 
        'm2lv' =>array(), 
        'b1' =>array(), 
        'b2'  =>array(), 
        'b3' =>array(), 
        'b1type' =>array(), 
        'b2type'  =>array(), 
        'b3type' =>array(), 
        'b1lv' =>array(), 
        'b2lv'  =>array(), 
        'b3lv'  =>array()
    );
    private $postData = array(
        'cdno' =>array(), 
        'chno' =>array(), 
        'img'  =>array(), 
        'lv' =>array(), 
        'hp' =>array(), 
        'atk'  =>array(), 
        'm1' =>array(), 
        'm2'  =>array(), 
        'm1buf' =>array(), 
        'm2buf' =>array(), 
        'm1lv'  =>array(), 
        'm2lv' =>array(), 
        'b1' =>array(), 
        'b2'  =>array(), 
        'b3' =>array(), 
        'b1type' =>array(), 
        'b2type'  =>array(), 
        'b3type' =>array(), 
        'b1lv' =>array(), 
        'b2lv'  =>array(), 
        'b3lv'  =>array()
    );
    function login(){ // ログイン状況を把握
        if($_SESSION['userID'] != "" && $_SESSION['myTB'] != ""){ // ユーザーがログインしていたらそのままユーザー名を返す
            return 'ユーザーID:'.$_SESSION['userID'];
        }
        // 誰もログインしていなかったらMAXデータを設定してユーザー名を返す
        $_SESSION['myTB'] = "H1_2_DefaultDataMax";
        return 'ユーザーID:'.$_SESSION['userID'];
    }
    function DBselect(){ // カードデータをデータベースから引き出す
        //データベースサーバに接続
        if (!$conn = mysqli_connect(HOST, USR, PASS, DB)){
            die('データベースに接続できません');
        }
        //クエリの文字コードを設定
        mysqli_set_charset($conn, 'utf8');
        //SQL文の作成
        $sql = "SELECT d1.cdno, d1.chno, d1.cimg, d2.lv, d2.hp, d2.atk, "
             . "d1.m1_1, d1.m2_1, d1.m1buf_1, d1.m2buf_1, "
             . "d1.m1_5, d1.m2_5, d1.m1buf_5, d1.m2buf_5, "
             . "d1.m1_10, d1.m2_10, d1.m1buf_10, d1.m2buf_10, "
             . "d2.m1lv, d2.m2lv, "
             . "d1.b1, d1.b2, d1.b3, d1.b1type, d1.b2type, d1.b3type, d2.b1lv, d2.b2lv, d2.b3lv "
             . "FROM H1_1_CardData AS d1 INNER JOIN ".$_SESSION['myTB']." AS d2 ON d1.cdno = d2.cdno "
            //  . "WHERE d1.cdno <= 10 "
             . "ORDER BY d1.cdno ASC"; // H1_1_CardDataを基準
        //ステートメントン実行準備
        $stmt = mysqli_prepare($conn, $sql);
        //SQLステートメントの実行
        mysqli_stmt_execute($stmt); 
        mysqli_stmt_store_result($stmt);
        $num = mysqli_stmt_num_rows($stmt);            
        if($num > 0){
            //データの取得
            //取り出した値を変数に入れる
            $i = 0;
            mysqli_stmt_bind_result($stmt, $cdN, $chN, $cimg, $clv, $chp, $catk,
                                           $m1_1, $m2_1, $m1b_1, $m2b_1,
                                           $m1_5, $m2_5, $m1b_5, $m2b_5,
                                           $m1_10, $m2_10, $m1b_10, $m2b_10,
                                           $m1lvl, $m2lvl,
                                           $bd1, $bd2, $bd3, $b1T, $b2T, $b3T, $b1lvl, $b2lvl, $b3lvl);
            while(mysqli_stmt_fetch($stmt)){
                $this->cardData['cdno'][$i] = $cdN;
                $this->cardData['chno'][$i] = $chN;
                $this->cardData['img'][$i] = $cimg;
                $this->cardData['lv'][$i] = $clv;
                $this->cardData['hp'][$i] = $chp;
                $this->cardData['atk'][$i] = $catk;
                switch ($m1lvl - $m1lvl % 5) {
                    case 0:
                        $this->cardData['m1'][$i] = $m1_1;
                        $this->cardData['m1buf'][$i] = $m1b_1;
                        break;
                    case 5:
                        $this->cardData['m1'][$i] = $m1_5;
                        $this->cardData['m1buf'][$i] = $m1b_5;
                        break;
                    case 10:
                        $this->cardData['m1'][$i] = $m1_10;
                        $this->cardData['m1buf'][$i] = $m1b_10;
                        break;
                }
                switch ($m2lvl - $m2lvl % 5) {
                    case 0:
                        $this->cardData['m2'][$i] = $m2_1;
                        $this->cardData['m2buf'][$i] = $m2b_1;
                        break;
                    case 5:
                        $this->cardData['m2'][$i] = $m2_5;
                        $this->cardData['m2buf'][$i] = $m2b_5;
                        break;
                    case 10:
                        $this->cardData['m2'][$i] = $m2_10;
                        $this->cardData['m2buf'][$i] = $m2b_10;
                        break;
                }
                $this->cardData['m1lv'][$i] = $m1lvl;
                $this->cardData['m2lv'][$i] = $m2lvl;
                $this->cardData['b1'][$i] = $bd1;
                $this->cardData['b2'][$i] = $bd2;
                $this->cardData['b3'][$i] = $bd3;
                $this->cardData['b1type'][$i] = $b1T;
                $this->cardData['b2type'][$i] = $b2T;
                $this->cardData['b3type'][$i] = $b3T;
                $this->cardData['b1lv'][$i] = $b1lvl;
                $this->cardData['b2lv'][$i] = $b2lvl;
                $this->cardData['b3lv'][$i] = $b3lvl;
                $i++;
            }
        }
        // var_dump("cardData//");
        // var_dump($this->cardData);
        //データベースの接続を閉じる
        mysqli_stmt_free_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    
    function DataPOST(){ // 更新データを配列に入れる
        // var_dump("input//");
        // var_dump(file_get_contents('php://input'));
        if(isset($_POST["submit"]) && $_POST["submit"] == "更新") {
            $postdata = file_get_contents('php://input');
            $i = 0;
            foreach(explode('&', trim($postdata)) as $pd){
                $D = explode('=', trim($pd));
                $dataName = explode('_', trim($D[0]));
                $dataNum = explode('mcard', trim($dataName[0]));
                // $data = $D[1];
                if($D[1] != $this->cardData[$dataName[1]][(int)$dataNum[1]]){
                    $this->postData[$dataName[1]][] = $D[1];
                    //TODO
                }
                // $this->postData[$dataName[1]][] = $D[1] != $this->cardData[$dataName[1]][(int)$dataNum[1]] ? $D[1] : ;
                // $this->cardData[$dataName[1]][(int)$dataNum[1]] = $D[1];
                // if(i < 10){
                //     var_dump("<br>");
                // //     var_dump($D);
                //     var_dump($dataNum);
                // //     // var_dump($this->cardData['lv'][i]);
                // //     // var_dump($this->cardData['a']);
                //     var_dump("<br>");
                // }
                // $i++;
            }
            // var_dump("data//");
            // var_dump($data);
            // for($i = 0; $i < count($this->cardData['cdno']); $i++){
            //     $this->cardData['cdno'][$i] = $data[$i*10+1];
            //     $this->cardData['lv'][$i] = $data[$i*10+3];
            //     $this->cardData['hp'][$i] = $data[$i*10+4];
            //     $this->cardData['atk'][$i] = $data[$i*10+5];
            //     $this->cardData['m1lv'][$i] = $data[$i*10+6];
            //     $this->cardData['m2lv'][$i] = $data[$i*10+7];
            //     $this->cardData['b1lv'][$i] = $data[$i*10+8];
            //     $this->cardData['b2lv'][$i] = $data[$i*10+9];
            //     $this->cardData['b3lv'][$i] = $data[$i*10+10];
            // }
            var_dump("cardData//");
            var_dump($this->postData);
        }         
    }
            
    function DBupdate(){ // ユーザデータ更新
        if(isset($_POST["submit"]) && $_POST["submit"] == "更新") {    
            //データベースサーバに接続
            if (!$conn = mysqli_connect(HOST, USR, PASS, DB)) {
                die('データベースに接続できません');
            }
            //クエリの文字コードを設定
            mysqli_set_charset($conn, 'utf8');
            $msg = "";
            for($i = 0; $i < count($this->postData['cdno']); $i++){
                //SQL文の作成
                $sql = "UPDATE H1_3_UserData1 "
                    . "SET lv = ?, hp = ?, atk = ?, m1lv = ?, m2lv = ?, b1lv = ?, b2lv = ?, b3lv = ? "
                    . "WHERE cdno = ?";
                
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 'sssssssss', 
                    $this->postData['lv'][$i], $this->postData['hp'][$i], $this->postData['atk'][$i], $this->postData['m1lv'][$i], 
                    $this->postData['m2lv'][$i],$this->postData['b1lv'][$i], $this->postData['b2lv'][$i], $this->postData['b3lv'][$i], 
                    $this->postData['cdno'][$i]);
                mysqli_stmt_execute($stmt);
                if(mysqli_stmt_affected_rows($stmt) > 0){
                    $msg = "更新完了しました！";	
                }
            }
            //データベースの接続を閉じる
            mysqli_stmt_free_result($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
        return $msg;
    }
    
    function updateCard(){ // カードデータを表示
        $Dormitory = array("","Heartslabyul","Savanaclaw","Octavinelle","Scarabia","Pomefiore","Ignihyde","Diasomnia");        
        for($i = 0; $i < count($this->cardData['cdno']); $i++){
            print '<div class="mcards">';
            /** カードの写真 */
            print     '<img src="../img/Hobby_1/'.$Dormitory[(int)$this->cardData['chno'][$i]/10].'/'.$this->cardData['img'][$i].'" alt="'.$this->cardData['chno'][$i].'" width="70.5" height="74.7" id="mcard'.$i.'">';
//            print     '<img src="../img/Hobby_1/'.$Dormitory[(int)($this->chno[$i]/10)].'/'.(int)($this->chno[$i]/10).'.jpg" alt="'.$this->chno[$i].'" width="75" height="75" id="mcard'.$i.'">';
//            print     '<br><input type="text" readonly="readonly" id="mcard'.$i.'_lbl" value="'.$this->img[$i].'">';
            /** 隠しデータ(カードNo,キャラクターNo) */
            print     '<input type="hidden" name="mcard'.$i.'_cdno" id="mcard'.$i.'_cdno" value="'.$this->cardData['cdno'][$i].'">';
            print     '<input type="hidden" name="mcard'.$i.'_chno"id="mcard'.$i.'_chno" value="'.$this->cardData['chno'][$i].'">';
            $this->statusBasics($i);
            $this->statusMagic($i);
            $this->statusBuddy($i);
            print '</div>';
        }
        print     '<input type="hidden" id="cardlen" value="'.count($this->cardData['cdno']).'">';
    }
    function statusBasics($i){
        print '<table border="0" id="THpAtk">'
            . '<tr>'
                . '<td>Lv</td>'
                . '<td>'
                . '<select-cardlv id="mcard'.$i.'_lv" name="mcard'.$i.'_lv" '.$this->enabled().'></select-cardlv>'
                . '<input id="mcard'.$i.'_lvH" type="hidden" value="'.$this->cardData['lv'][$i].'" '.$this->readonly().'>'
                . '</td>'
            . '</tr>'
            . '<tr>'
                . '<td>HP</td>'
                . '<td><input type="text" class="mdata" name="mcard'.$i.'_hp" id="mcard'.$i.'_hp" value="'.$this->cardData['hp'][$i].'" maxlength="5"'.$this->readonly().'></td>'
            . '</tr>'
            . '<tr>'
                . '<td>ATK</td>'
                . '<td><input type="text" class="mdata" name="mcard'.$i.'_atk" id="mcard'.$i.'_atk" value="'.$this->cardData['atk'][$i].'" maxlength="5"'.$this->readonly().'></td>'
            . '</tr>'
            . '</table>';
    }
    function statusMagic($i){
        $Element = array("Nomal.jpg","Fire.jpg","Tree.jpg","Water.jpg");
        print '<table border="0" id="THpAtk">'
            . '<tr>'
                . '<td>'
                . '<img id="mcard'.$i.'_m1" src="../img/Hobby_1/Element/'.$Element[substr($this->cardData['m1'][$i],0,1)].'" alt="" width="20" height="20">'
                . '</td>'
                . '<td>Lv</td>'
                . '<td>'
                . '<select-lv id="mcard'.$i.'_m1lv" name="mcard'.$i.'_m1lv" '.$this->enabled().'></select-lv>'
                . '<input id="mcard'.$i.'_m1lvH" type="hidden" value="'.$this->cardData['m1lv'][$i].'" maxlength="2"'.$this->readonly().'>'
                . '</td>'
            . '</tr>'
            . '<tr>'
                . '<td>'
                . '<img id="mcard'.$i.'_m2" src="../img/Hobby_1/Element/'.$Element[substr($this->cardData['m2'][$i],0,1)].'" alt="" width="20" height="20">'
                . '</td>'
                . '<td>Lv</td>'
                . '<td>'
                . '<select-lv id="mcard'.$i.'_m2lv" name="mcard'.$i.'_m2lv" '.$this->enabled().'></select-lv>'
                . '<input id="mcard'.$i.'_m2lvH" type="hidden" value="'.$this->cardData['m2lv'][$i].'" '.$this->readonly().'>'
                . '</td>'
            . '</tr>'
            . '</table>';
    }
    function statusBuddy($i){
        print '<table border="0">'
            . '<tr>'
                . '<td><img id="mcard'.$i.'_b1" src="../img/Hobby_1/Another/'.$this->cardData['b1'][$i].'.jpg" alt="" width="30" height="30"></td>'
                . '<td><img id="mcard'.$i.'_b2" '.$this->hide($this->cardData['b2'][$i]).' src="../img/Hobby_1/Another/'.$this->cardData['b2'][$i].'.jpg" alt="" width="30" height="30"></td>'
                . '<td><img id="mcard'.$i.'_b3" '.$this->hide($this->cardData['b3'][$i]).' src="../img/Hobby_1/Another/'.$this->cardData['b3'][$i].'.jpg" alt="" width="30" height="30"></td>'
            . '</tr>'
            . '<tr>'
                . '<td>'
                . 'Lv<select-lvzero id="mcard'.$i.'_b1lv" name="mcard'.$i.'_b1lv" '.$this->enabled().'></select-lvzero>'
                . '<input id="mcard'.$i.'_b1lvH" type="hidden" value="'.$this->cardData['b1lv'][$i].'">'
                . '</td>'
                . '<td>'
                . 'Lv<select-lvzero id="mcard'.$i.'_b2lv" name="mcard'.$i.'_b2lv" '.$this->enabled().'></select-lvzero>'
                . '<input id="mcard'.$i.'_b2lvH" '.$this->hide($this->cardData['b2'][$i]).' type="hidden" value="'.$this->cardData['b2lv'][$i].'">'
                . '</td>'
                . '<td>'
                . 'Lv<select-lvzero id="mcard'.$i.'_b3lv" name="mcard'.$i.'_b3lv" '.$this->enabled().'></select-lvzero>'
                . '<input id="mcard'.$i.'_b3lvH" '.$this->hide($this->cardData['b3'][$i]).' type="hidden" value="'.$this->cardData['b3lv'][$i].'">'
                . '</td>'
            . '</tr>'
            . '</table>';
    }
    function hide($b){
        if($b == 0){
            return 'class="hidden"';
        }else{
            return '';
        }
    }
    function readonly(){
        if($_SESSION['userID'] == ""){
            return ' readonly';
        }else{
            return '';
        }
    }
    function enabled(){
        if($_SESSION['userID'] == ""){
            return ' disabled';
        }else{
            return '';
        }
    }
}