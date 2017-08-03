<?php
/**
 * Created by PhpStorm.
 * User: jaxson
 * Date: 2017/7/3
 * Time: 下午5:42
 *
 */

$regex = '/^\s*\[x\]\s*/';

$test = '[x]';

if ( preg_match($regex,$test) ) {
	echo "Yes";
} else {
	echo "No";
}