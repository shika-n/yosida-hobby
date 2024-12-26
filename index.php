<?php
require("components.php");
require("templates.php");

$comp = new Component();

$quick_access = $comp->quick_access_menu([
	"私の趣味" => "#top",
	"PSO:NGS" => "#psongs",
	"ラグナロクオンライン" => "#ragnarok",
]);

$content = <<< ___EOF
	<h1 class="text-xl">私の趣味</h1>
	<hr class="my-2 border-gray">
	<p>私の趣味はゲームです！最近時間があまりないですが、好きなゲームを２つ紹介させてもらいます！！</p>
	<p>その２つのゲームはこちら：</p>
	{$comp->boxed_list("好きなゲーム", [
		"PSO:NGS" => "#psongs",
		"ラグナロクオンライン" => "#ragnarok"
	])}	
	<h1 id="psongs" class="text-xl mt-8"><a href="https://lp.pso2.jp" target="_blank">PSO NGS</a></h1>
	<hr class="my-2 border-gray">
	{$comp->image("images/ngs/top-pc2.jpg")}
	<p>Phantasy Star Online 2: New GenesisはMMORPGゲームで他の人敵を倒すゲームです。もともとはPhantasy Star Online 2 (PSO2)と呼ばれましたが、大きなアップデート後PSO:NGSになりました。</p>
	<p>PSO2と違い、PSONGSでマップ移動するときにはローディング画面はありません！待つ時間を減っているので途切れなく楽しめます！</p>
	{$comp->image("images/ngs/ss12.jpg")}
	<p>PSO:NGSのキャラクタのカスタマイゼーションがMMORPGゲームの中では一位だと思います。顔の表情と服だけじゃなく、体の形、服の色、アクセサリーの位置までが設定可能です！このカスタマイゼーション機能がきかけでPSO:NGSを始めました。</p>

	<h1 id="ragnarok" class="text-xl mt-8"><a href="https://ragnarokonline.gungho.jp" target="_blank">ラグナロクオンライン</a></h1>
	<hr class="my-2 border-gray">
	{$comp->image("images/ro/logo.webp", "bg-white")}
	<p>韓国のMMORPGで2002年からサービス開始したゲームです。このゲームは中学生の頃からやっています。何回もやめたことありますが、やめてから何月経つともう一回やりたくなるゲームです。</p>
	{$comp->image("images/ro/ro_fb_screenshot_example.jpg")}
	<p>自分にとって他のゲームで同じ懐かしさが得られないゲームです。ラグナロクオンライン２もありますが、ラグナロクオンラインと比べるとプレイヤーが少なくて、2019年に開発完了になりました。</p>
	<p>日本版のも試したいと思います。</p>
	<iframe class="w-full md:w-4/5 mx-auto my-2 aspect-video" src="https://www.youtube.com/embed/BqijsweJzFQ?si=DeCQwH6CqzFrZApa" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
	<p>こちらも一番好きなサウンドトラックです！聞いてみてください！</p>
___EOF;

$html = str_replace("<!-- QUICK ACCESS -->", $quick_access, $html);
$html = str_replace("<!-- CONTENT -->", $content, $html);
echo $html;
