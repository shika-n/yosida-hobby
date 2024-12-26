<?php
$html = <<< ___EOF
<!DOCTYPE html>
<html lang="ja" class="scroll-smooth">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Hobby</title>
		<script src="https://cdn.tailwindcss.com"></script>
		<link href="css/style.css" rel="stylesheet">
	</head>
	<body class="bg-slate-800 text-white">
		<header class="w-full top-0">
			<nav class="flex justify-between items-center px-4 bg-violet-950 shadow-xl shadow-slate-900/60">
				<h1 class="my-4 text-2xl font-bold select-none"><a href="/hobby">私のHobby</a></h1>
				<div class="flex gap-2">
					<a href="/hobby" class="p-2 text-lg select-none rounded-sm hover:bg-violet-800/50">Hobby</a>
					<a href="/hobby/video.php" class="p-2 text-lg select-none rounded-sm hover:bg-violet-800/50">Past Projects</a>
					<a href="/hobby/demo.php" class="p-2 text-lg select-none rounded-sm hover:bg-violet-800/50">Demo</a>
				</div>
			</nav>
		</header>
		<main class="mt-8 mb-8 leading-8">
			<img id="imageView" class="fixed z-10 left-0 top-0 p-4 m-auto w-full h-full object-contain scale-0 backdrop-blur-none transition-all ease-in-out duration-300">
			<a class="fixed p-3 rounded-full right-8 bottom-8 font-bold font-xl bg-violet-800 shadow-xl shadow-slate-900/60" href="#top">TOP</a>
			<div class="flex flex-col md:flex-row w-full md:w-3/4 mx-auto gap-4">
				<div class="min-w-48 p-4">
					<ul class="md:sticky top-4">
						<!-- QUICK ACCESS -->
					</ul>
				</div>
				<div class="grow px-6 py-4 rounded-xl bg-slate-700 shadow-lg shadow-slate-900/60 font-serif">
					<!-- CONTENT -->
				</div>
			</div>
		</main>
		<script src="js/imageView.js"></script>
	</body>
</html>
___EOF;
