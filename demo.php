<?php
require("components.php");
require("templates.php");

$comp = new Component();

$quick_access = $comp->quick_access_menu([
	"TOP" => "#top",
	"デモ" => "#demo",
	"何これ" => "#nani",
]);

$content = <<< ___EOF
	<h1 id="demo" class="text-xl">デモ</h1>
	<hr class="my-2 border-gray">
	<canvas id="canvas" width="400" height="225" tabindex="1" class="w-full aspect-auto border-2 border-slate-700 rounded-xl ring-0 ring-white hover:ring-2 transition-all">
		Canvas screen
	</canvas>
	<p id="fps">0 FPS</p>
	<p id="pos">XYZ</p>
	<p id="ang">XY</p>

	<h1 id="demo" class="text-xl mt-8">何これ</h1>
	<hr class="my-2 border-gray">
	<p>あくまでもデモしか言えないですね。ゴールないし、やることないし…</p>
	<p>昔見たプロジェクト自分で作れるかなと思って、作ってみています。</p>

	<script src="js/util.js"></script>
	<script src="js/demo.js"></script>
___EOF;

$html = str_replace("<!-- QUICK ACCESS -->", $quick_access, $html);
$html = str_replace("<!-- CONTENT -->", $content, $html);
echo $html;
