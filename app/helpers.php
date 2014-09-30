<?php

function clean_date($date){
	return date("D, M d Y", strtotime($date));
}

function clean_time($date){
	return date("H:i", strtotime($date));
}
