<?php
require("components.php");
require("templates.php");

$comp = new Component();

$quick_access = $comp->quick_access_menu([
	"昔作ったシンプルなゲーム" => "#top",
	"OOP課題" => "#ooprpg",
	"音ゲー" => "#rythm",
]);

$content = <<< ___EOF
	<h1 id="ooprpg" class="text-xl">OOP課題</h1>
	<hr class="my-2 border-gray">
	<iframe class="w-full md:w-4/5 mx-auto my-2 aspect-video" src="https://www.youtube.com/embed/ARLunPXRTDk?si=cT18ot4ChU6NnwS8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
	<p>こちらのRPGゲームは確かJavaで作りました。オブジェクト指向プログラミング授業の課題のため、四人ぐらいのグループで作りました。ちなみに僕はリーダーでした！</p>
	<h1 id="rythm" class="text-xl mt-8">音ゲー</h1>
	<hr class="my-2 border-gray">
	<iframe class="w-full md:w-4/5 mx-auto my-2 aspect-video" src="https://www.youtube.com/embed/5dTUg8cVxAg?si=D_njVbc8CSw3K1Rx" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
	<p>こちら学際みたいなイベントで展示するため作りました。この音ゲーはC++と確か<a class="underline decoration-dashed" target="_blank" href="https://www.sfml-dev.org">SFML</a>というライブラリで作りました。コンピューターグラフィック、特にOpenGLということに興味が強かったです！</p>
___EOF;

$html = str_replace("<!-- QUICK ACCESS -->", $quick_access, $html);
$html = str_replace("<!-- CONTENT -->", $content, $html);
echo $html;
