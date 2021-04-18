<?php

class Hobby_1_1_homeM2{
    function printCards(){
        for($i = 1; $i <= 5; $i++){
        print '<div class="cards">'
                . '<img id="card'.$i.'" src="../img/Hobby_1/none.jpg" width="70.5" height="74.7" onclick="clickOpenModal(this)">' 
                . '<input id="card'.$i.'_cdno" type="hidden" value="0">'
                . '<input id="card'.$i.'_chno" type="hidden" value="-1">'
                . '<input id="card'.$i.'_lv" type="hidden" value="0">'
                . '<input id="card'.$i.'_m1_1" type="hidden" value="0"><input id="card'.$i.'_m2_1" type="hidden" value="0">'
                . '<input id="card'.$i.'_m1_5" type="hidden" value="0"><input id="card'.$i.'_m2_5" type="hidden" value="0">'
                . '<input id="card'.$i.'_m1_10" type="hidden" value="0"><input id="card'.$i.'_m2_10" type="hidden" value="0">'
                . '<input id="card'.$i.'_m1buf_1" type="hidden" value="0"><input id="card'.$i.'_m2buf_1" type="hidden" value="0">'
                . '<input id="card'.$i.'_m1buf_5" type="hidden" value="0"><input id="card'.$i.'_m2buf_5" type="hidden" value="0">'
                . '<input id="card'.$i.'_m1buf_10" type="hidden" value="0"><input id="card'.$i.'_m2buf_10" type="hidden" value="0">'
                . '<input id="card'.$i.'_b1" type="hidden" value="0"><input id="card'.$i.'_b2" type="hidden" value="0"><input id="card'.$i.'_b3" type="hidden" value="0">'
                . '<input id="card'.$i.'_b1type" type="hidden" value="0"><input id="card'.$i.'_b2type" type="hidden" value="0"><input id="card'.$i.'_b3type" type="hidden" value="0">'
                . '<input id="card'.$i.'_hpmax" type="hidden" value="0">'
                . '<input id="card'.$i.'_atkmax" type="hidden" value="0">'
            . '</div>';
        }
    }
    
    function printStatuses(){
        for($i = 1; $i <= 5; $i++){
            print '<div class="statuses">';
            $this->status1($i);
            $this->status2($i);
            $this->status3($i);
            print '</div>';
        }
    }
    
    function status1($i){
        print '<table border="0" class="THpAtk">'
            . '<tr>'
            .     '<td colspan="3">'
            .     '<label><input id="card'.$i.'_max" type="checkbox" value="card'.$i.'" onclick="clickMAX(this)">最大値</label><br>'
            .     '</td>' 
            . '</tr>'
            . '<tr>'
            .     '<td class="lbl">'
            .     'HP'
            .     '</td>'
            .     '<td>'
            .     '<input id="card'.$i.'_hpbuf" class="text1" type="text" value="" readonly>'
            .     '</td>'
            .     '<td>'
            .     '<input id="card'.$i.'_hp" class="text" type="text" value="" onChange="clickChange()">'
            .     '</td>'
            . '</tr>'
            . '<tr>'
            .     '<td class="lbl">'
            .     'ATK'
            .     '</td>'
            .     '<td>'
            .     '<input id="card'.$i.'_atkbuf" class="text1" type="text" value="" readonly>'
            .     '</td>'
            .     '<td>'
            .     '<input id="card'.$i.'_atk" class="text" type="text" value="" onChange="clickChange()">'
            .     '</td>'
            . '</tr>'
            . '</table>';
    }
    function status2($i){
        print '<table border="0" class="TBaddy">'
            . '<tr>'
            .     '<td>'
            .     '<img id="card'.$i.'_budy1" src="../img/Hobby_1/off.png" style="background-image:url(../img/Hobby_1/none.jpg);background-size:contain;" width="35" height="35">'
            .     '</td>'
            .     '<td>'
            .     '<img id="card'.$i.'_budy2" src="../img/Hobby_1/off.png" style="background-image:url(../img/Hobby_1/none.jpg);background-size:contain;" width="35" height="35">'
            .     '</td>'
            .     '<td>'
            .     '<img id="card'.$i.'_budy3" src="../img/Hobby_1/off.png" style="background-image:url(../img/Hobby_1/none.jpg);background-size:contain;" width="35" height="35">'
            .     '</td>'
            . '</tr>'
            . '<tr>'
            .     '<td id="card'.$i.'_b1ty">'
            .     '***<br>***'
            .     '</td>'
            .     '<td id="card'.$i.'_b2ty">'
            .     '***<br>***'
            .     '</td>'
            .     '<td id="card'.$i.'_b3ty">'
            .     '***<br>***'
            .     '</td>'
            . '</tr>'
            . '<tr>'
            .     '<td>'
                . '<select-lv id="card'.$i.'_b1lv" class="select" onclick="clickChange()"></select-lv>'
            .     '</td>'
            .     '<td>'
                . '<select-lv id="card'.$i.'_b2lv" class="select" onclick="clickChange()"></select-lv>'
            .     '</td>'
            .     '<td>'
                . '<select-lv id="card'.$i.'_b3lv" class="select" onclick="clickChange()"></select-lv>'
            .     '</td>'
            . '</tr>'
            . '</table>';
    }
    function status3($i){
        print '<table border="0" id="card'.$i.'_TMagic1" style="font-size: 13px;">'
            . '<tr>'
            .     '<td colspan="2">'
            .     '<label><input id="card'.$i.'_MtORf1" type="checkbox" value="0" onclick="clickChange()" checked>使用する</label>'
            .     '</td>'
            . '</tr>'
            . '<tr>'
            .     '<td class="TL">'
            .     'M1<input id="card'.$i.'_d1" class="text1" type="text" value="" readonly="readonly">'
            .     '</td>'
            .     '<td>'
                . 'Lv<select-lv id="card'.$i.'_m1lv" onclick="clickMLvChange()"></select-lv>'
            .     '</td>'
            . '</tr>'
            . '<tr style="font-size: 10px;">'
            .     '<td>'
            .     '有利<input id="card'.$i.'_ADd1" class="text1" type="text" value="" readonly="readonly">'
            .     '</td>'
            .     '<td>'
            .     '不利<input id="card'.$i.'_DISd1" class="text1" type="text" value="" readonly="readonly">'
            .     '</td>'
            . '</tr>'
            . '<tr>'
            .     '<td colspan="2">'
            .     '<label><input id="card'.$i.'_buf1_1" type="checkbox" value="0" onclick="clickChange()" checked><span id="card'.$i.'_buf1_1Name">**********<br>**********</span></label>'
            .     '</td>'
            . '</tr>'
            . '<tr>'
            .     '<td colspan="2">'
            .     '<label><input id="card'.$i.'_buf1_2" type="checkbox" value="0" onclick="clickChange()"><span id="card'.$i.'_buf1_2Name">**********<br>**********</span></label>'
            .     '</td>'
            . '</tr>'
            . '<tr style="height: 20px;">'
            .     '<td id="card'.$i.'_bufA1" colspan="2">'
            .     '</td>'
            . '</tr>'
            . '</table>'
            . '<table border="0" id="card'.$i.'_TMagic2" style="font-size: 13px;">'
            . '<tr>'
            .     '<td colspan="2">'
            .     '<label><input id="card'.$i.'_MtORf2" type="checkbox" value="0" onclick="clickChange()" checked>使用する</label>'
            .     '</td>'
            . '</tr>'
            . '<tr>'
            .     '<td class="TL">'
            .     'M2<input id="card'.$i.'_d2" class="text1" type="text" value="" readonly="readonly">'
            .     '</td>'
            .     '<td>'
                . 'Lv<select-lv id="card'.$i.'_m2lv" onclick="clickMLvChange()"></select-lv>'
            .     '</td>'
            . '</tr>'
            . '<tr style="font-size: 10px;">'
            .     '<td>'
            .     '有利<input id="card'.$i.'_ADd2" class="text1" type="text" value="" readonly="readonly">'
            .     '</td>'
            .     '<td>'
            .     '不利<input id="card'.$i.'_DISd2" class="text1" type="text" value="" readonly="readonly">'
            .     '</td>'
            . '</tr>'
            . '<tr>'
            .     '<td colspan="2">'
            .     '<label><input id="card'.$i.'_buf2_1" type="checkbox" value="0" onclick="clickChange()"><span id="card'.$i.'_buf2_1Name">**********<br>**********</span></label>'
            .     '</td>'
            . '</tr>'
            . '<tr>'
            .     '<td colspan="2">'
            .     '<label><input id="card'.$i.'_buf2_2" type="checkbox" value="0" onclick="clickChange()" checked><span id="card'.$i.'_buf2_2Name">**********<br>**********</span></label>'
            .     '</td>'
            . '</tr>'
            . '<tr style="height: 20px;">'
            .     '<td id="card'.$i.'_bufA2" colspan="2">'
            .     '</td>'
            . '</tr>'
            . '</table>';
    }
}