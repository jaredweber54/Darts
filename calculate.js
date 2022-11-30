"use strict"
var total_score = 0;

function calc(){
     var txt = document.getElementById('txt').value;
     var score = parseInt(txt);
     var p_score = document.getElementById('scores');
     var p_tot_score = document.getElementById('total_score')
     p_score.innerHTML += " " + score;
     total_score += score;
     p_tot_score.innerHTML = total_score;
     
    }